<?php

namespace Database\Factories;

use Domain\Product\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{

    protected $model = Property::class;
    public function definition()
    {
        return [
            'title' => ucfirst($this->faker->word())
        ];
    }
}
