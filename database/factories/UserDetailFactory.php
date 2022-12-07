<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
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
            'username'=> fake()->unique()->userName(),
            'profile_image' => asset('assets\uploads\default.jpg'),
            'tac'=> random_int(1000, 9999),
            'tax'=> random_int(1000, 9999),
            'imf'=> random_int(1000, 9999),
            'pound_balance'=> 0.00,
            'dollar_balance'=>0.00,
            'euro_balance'=>0.00,
            'account_number'=>$account_number,
            'account_type'=> 'Saving Account',
        ];
    }
}
