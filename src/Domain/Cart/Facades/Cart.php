<?php

namespace Domain\Cart\Facades;

use Domain\Cart\CartManager;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Model|Builder add(Product $product, int $quantity = 1, array $option_values = null)
 * @see CartManager
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): CartManager
    {
        return app(CartManager::class);
    }
}
