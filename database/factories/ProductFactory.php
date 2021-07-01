<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(50),
            'stock' => $this->faker->numberBetween(-1,200),
            'purchase_price' => $this->faker->randomFloat(2, 10.1, 9999.9),
            'sale_price' => $this->faker->randomFloat(2, 10.1, 9999.9),
            'category_id' => Category::all()->random()->id,
            'establishment_id' => Establishment::all()->random()->id,
            'created_by' => User::all()->random()->id,
        ];
    }
}
