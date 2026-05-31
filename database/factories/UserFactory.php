<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'password' => bcrypt('password'),
            'role' => 'owner'
        ];

    }
}
