<?php

namespace Domain\Order\Processes;

use Domain\Cart\Facades\Cart;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

class ClearCart implements OrderProcessContract
{

    public function __invoke(Order $order, $next)
    {
        Cart::truncate();

        return $next($order);
    }
}
