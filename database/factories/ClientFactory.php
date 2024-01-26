<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name'=>$this->faker->name(),
            'email'=>$this->faker->email(),
            'last_name'=>$this->faker->lastName(),
            'license'=>$this->faker->randomNumber(8),
            'phone_number'=>$this->faker->phoneNumber(),
            'addres'=>$this->faker->streetAddress(),
             
        ];
    }
}
