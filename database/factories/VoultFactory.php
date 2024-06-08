<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voult>
 */
class VoultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_name' => fake()->name(),
            'category' => fake()->name(),
            'service_url' => fake()->url(),
            'service_type' => fake()->name(),
            'service_password' => fake()->password(),
            'user_id' => random_int(1,5),
        ];
    }
}
