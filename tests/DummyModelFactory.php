<?php

namespace BinaryCats\Sku\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;

class DummyModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DummyModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
