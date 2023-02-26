<?php

declare(strict_types=1);

namespace Domain\Order\States\Payment;

final class CancelledPaymentState extends PaymentState
{
    public static string $name = 'failed';
}
