<?php

namespace App\Http\Controllers;

use Domain\Cart\Facades\Cart;
use Domain\Cart\Models\CartItem;
use Domain\Product\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('cart.index', [
            'items' => cart()->items()
        ]);
    }


    public function add(Product $product): RedirectResponse
    {
        Cart::add(
            $product,
            request('quantity', 1),
            request('options', []),
        );

        flash()->info('Товар добавлен в корзину');

        return redirect()
            ->intended(route('cart'));
    }


    public function quantity(CartItem $item): RedirectResponse
    {
        Cart::quantity($item, request('quantity', 1));
        flash()->info('Количество товаров изменено');

        return redirect()
            ->intended(route('cart'));
    }


    public function delete(CartItem $item): RedirectResponse
    {
        Cart::delete($item);
        flash()->info('Удалено из корзины');

        return redirect()
            ->intended(route('cart'));
    }


    public function truncate(): RedirectResponse
    {
        Cart::truncate();
        flash()->info('Корзина очищена');

        return redirect()
            ->intended(route('cart'));
    }
}
