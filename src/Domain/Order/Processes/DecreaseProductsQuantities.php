<?php

namespace Domain\Order\Processes;

use Domain\Cart\Facades\Cart;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;
use Illuminate\Support\Facades\DB;

class DecreaseProductsQuantities implements OrderProcessContract
{

    public function __invoke(Order $order, $next)
    {
        foreach (Cart::items() as $item) {
            $item->product()->update([
                'quantity' => DB::raw('quantity - ' . $item->quantity)
            ]);
        }

        return $next($order);
    }
}
