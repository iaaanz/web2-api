<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR as FakerBR;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            'nome' => $this->faker->name,
            'telefone' => $this->faker->phoneNumber,
            'cpf' => preg_replace('/[^0-9]/', '', $this->faker->cpf),
            'data' => $this->faker->date(),
        ];
    }
}
