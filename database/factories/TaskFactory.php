<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->randomLetter(),
            'description' => fake()->paragraph(),
            'due_date' => now()->addDays(7),
            'done' => fake()->boolean(),
            'created_at' => now()
        ];
    }
}
