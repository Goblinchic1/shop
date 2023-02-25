<?php

namespace Domain\Order\Processes;

use Domain\Cart\Facades\Cart;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Exceptions\OrderProcessException;
use Domain\Order\Models\Order;

class CheckProductQuantities implements OrderProcessContract
{

    /**
     * @throws OrderProcessException
     */
    public function __invoke(Order $order, $next)
    {
        foreach (Cart::items() as $item) {
            if ($item->product->quantity < $item->quantity) {
                throw new OrderProcessException('Не осталось товара');
            }
        }

        return $next($order);
    }
}
