<?php

namespace Support\ValueObjects;

use InvalidArgumentException;
use Support\Traits\Makeable;
use Stringable;

final class Price implements Stringable
{
    use Makeable;

    private array $currencies = [
        'RUB' => '₽'
    ];

    public function __construct(
        private readonly int|null $value,
        private readonly string $currency = 'RUB',
        private readonly int $precision = 100
    )
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        if (!isset($this->currencies[$this->currency])) {
            throw new InvalidArgumentException('Currency not allowed');
        }
    }


    public function raw(): int|null
    {
        return $this->value;
    }


    public function value():float|int|null
    {
        return $this->value / $this->precision;
    }


    public function currency(): string
    {
        return $this->currency;
    }


    public function symbol(): string
    {
        return $this->currencies[$this->currency];
    }

    public function __toString(): string
    {
        return number_format($this->value(), 0, ',', ' ')
            . ' ' . $this->symbol();
    }
}
