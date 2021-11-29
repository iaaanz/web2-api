<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR as FakerBR;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new FakerBR\Company($this->faker));
        $this->faker->addProvider(new FakerBR\Person($this->faker));
        $this->faker->addProvider(new FakerBR\PhoneNumber($this->faker));

        return [
            'nome' => $this->faker->company(),
            'telefone' => $this->faker->phoneNumber,
            'cnpj' => preg_replace('/[^0-9]/', '', $this->faker->cnpj),
            'data' => $this->faker->date(),
        ];
    }
}
