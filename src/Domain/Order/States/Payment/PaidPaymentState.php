<?php

declare(strict_types=1);

namespace Domain\Order\States\Payment;

final class PaidPaymentState extends PaymentState
{
    public static string $name = 'paid';
}
