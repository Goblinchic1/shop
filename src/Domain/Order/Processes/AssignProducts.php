<?php

namespace Domain\Order\Processes;

use Domain\Cart\Facades\Cart;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

final class AssignProducts implements OrderProcessContract
{
    public function __invoke(Order $order, $next)
    {
        $order->orderItems()
            ->createMany(
                Cart::items()->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'price' => $item->price,
                        'quantity' => $item->quantity
                    ];
                })->toArray()
            );

        return $next($order);
    }
}
