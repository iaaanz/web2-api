<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR as FakerBR;

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
        $this->faker->addProvider(new FakerBR\Person($this->faker));

        return [
            'nome' => $this->faker->word(),
            'quantidade' => $this->faker->randomNumber(3),
            'ncm' => $this->faker->randomNumber(8),
            'data' => $this->faker->date(),
        ];
    }
}
