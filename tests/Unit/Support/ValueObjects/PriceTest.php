<?php

namespace Tests\Unit\Support\ValueObjects;

use Support\ValueObjects\Price;
use Tests\TestCase;
use InvalidArgumentException;

class PriceTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_all(): void
    {
        $price = Price::make(10000);

        $this->assertInstanceOf(Price::class, $price);

        $this->assertEquals(100, $price->value());
        $this->assertEquals(10000, $price->raw());
        $this->assertEquals('₽', $price->symbol());
        $this->assertEquals('RUB', $price->currency());
        $this->assertEquals('100 ₽', $price);

        $this->expectException(InvalidArgumentException::class);

        Price::make(-10000);
        Price::make(10000, 'USD');
    }
}
