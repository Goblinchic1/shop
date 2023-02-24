<?php

namespace Domain\Cart;

use Domain\Cart\Models\Cart;
use Domain\Cart\Models\CartItem;
use Domain\Cart\StorageIdentities\SessionIdentityStorage;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Support\ValueObjects\Price;

final class CartManager
{
    public function __construct(
        protected SessionIdentityStorage $identityStorage
    )
    {
    }


    private function cacheKey(): string
    {
        return str('cart_' . $this->identityStorage->get())
            ->slug('_')
            ->value();
    }


    private function forgetCache(): void
    {
        Cache::forget($this->cacheKey());
    }


    private function storedData(string $id): array
    {
        $data = [
            'storage_id' => $id
        ];

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }


    private function stringedOptionValues(array $option_values = []): string
    {
        sort($option_values);
        return implode(';', $option_values);
    }


    public function add(Product $product, int $quantity = 1, array $option_values = null): Model|Builder
    {
        $cart = Cart::query()
            ->updateOrCreate([
                'storage_id' => $this->identityStorage->get()
            ], $this->storedData($this->identityStorage->get()));


        $cartItem = $cart->cartItems()->updateOrCreate([
            'product_id' => $product->getKey(),
            'string_option_values' => $this->stringedOptionValues($option_values)
        ], [
            'price' => $product->price,
            'quantity' => DB::raw("quantity + $quantity"),
            'string_option_values' => $this->stringedOptionValues($option_values)
        ]);

        $cartItem->optionValues()->sync($option_values);

        $this->forgetCache();

        return $cart;
    }


    public function quantity(CartItem $item, $quantity = 1): void
    {
        $item->update([
            'quantity' => $quantity
        ]);

        $this->forgetCache();
    }


    public function delete(CartItem $item): void
    {
        $item->delete();

        $this->forgetCache();
    }


    public function truncate(): void
    {
        $this->get()?->delete();

        $this->forgetCache();
    }


    public function cartItems(): Collection
    {
        return $this->get()?->cartItems ?? collect([]);
    }


    public function items(): Collection
    {
        if (!$this->get()) {
            return collect([]);
        }
        return CartItem::query()
            ->with(['product', 'optionValues.option'])
            ->whereBelongsTo($this->get())
            ->get();
    }


    public function count(): int
    {
        return $this->cartItems()->sum(function ($item) {
            return $item->quantity;
        });
    }


    public function amount(): Price
    {
        return Price::make(
            $this->cartItems()->sum(function ($item) {
                return $item->amount->raw();
            })
        );
    }


    public function get()
    {
        return Cache::remember($this->cacheKey(), now()->addHour(), function () {
            return Cart::query()
                ->with('cartItems')
                ->where('storage_id', $this->identityStorage->get())
                ->when(auth()->check(), fn(Builder $query) => $query->orWhere('user_id', auth()->id()))
                ->first() ?? false;
        });
    }
}
