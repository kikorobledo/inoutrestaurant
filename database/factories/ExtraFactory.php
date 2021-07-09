<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Extra;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Extra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'extra_number' => $this->faker->unique()->numberBetween(1,300),
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 10.1, 9999.9),
            'establishment_id' => Establishment::all()->random()->id,
            'created_by' => User::all()->random()->id,
        ];
    }
}
