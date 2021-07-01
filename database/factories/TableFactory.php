<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Table;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Table::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Mesa - ' . $this->faker->numberBetween(1,20),
            'establishment_id' => Establishment::all()->random()->id,
            'created_by' => User::all()->random()->id,
        ];
    }
}
