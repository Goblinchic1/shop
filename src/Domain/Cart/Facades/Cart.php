<?php

namespace Domain\Cart\Facades;

use Domain\Cart\CartManager;
use Domain\Cart\Models\CartItem;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Model|Builder add(Product $product, int $quantity = 1, array $option_values = [])
 * @method static void delete(CartItem $item)
 * @method static void quantity(CartItem $item, $quantity = 1)
 * @method static void truncate()
 * @method static int count()
 * @method static Collection items()
 * @see CartManager
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CartManager::class;
    }
}
