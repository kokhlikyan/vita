<?php

namespace Database\Factories;

use App\Models\User;
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
        // get users from the database and user random id
        $user = User::query()->inRandomOrder()->first();
        $data = [
            'user_id' => $user->id,
            'title' => $this->faker->sentence,
            'details' => $this->faker->paragraph,
            'completed' => false,
            'all_day' => $this->faker->boolean,
            'start_date' => $this->faker->dateTimeBetween(now(), '+3 month')
        ];
        return $data;
    }
}
