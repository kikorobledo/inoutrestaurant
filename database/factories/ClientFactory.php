<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_number' => $this->faker->unique()->numberBetween(1,200),
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'telephone' => $this->faker->phoneNumber,
            'establishment_id' => Establishment::all()->random()->id,
            'created_by' => User::all()->random()->id,
        ];
    }
}
