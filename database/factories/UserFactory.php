<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Str;
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
    public function definition()
    {
        $now = Carbon::now();
        $account_number = $now->year.$now->month.$now->day.random_int(100, 999);
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'username'=>fake()->unique()->userName(),
            'email_verified_at' => now(),
            'account_number' => $account_number,
            'password' => '$2y$10$MszU3d0Yb5/q5kl6bX2ZZOVc9qBHC1M0tYInLGjpqynU47H1aH.rq', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
