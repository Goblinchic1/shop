<?php

namespace Domain\Order\States;

class CancelledOrderState extends OrderState
{
    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): string
    {
        return 'cancelled';
    }

    public function humanValue(): string
    {
        return 'Отменён';
    }
}
