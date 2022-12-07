<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Setting;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(2)->create();
        // \App\Models\UserDetail::factory(2)->create();
        \App\Models\User::factory()->create([
            'name' => 'Zinc Creations',
            'username'=>'zinc',
            'email' => 'test@example.com',
            'type' => 1,
            'account_number' => '20221120488',
            'password'=>'$2y$10$waS8Zy1ki865Pe024NbWou7pwTG.naAVi9mreaLDgLJk1oPWv8t/m',
            'email_verified_at'=>'2022-11-20 17:24:32',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Vincent Michaels',
            'username'=>'vince',
            'email' => 'michaelsvince@test.com',
            'account_number' => '20221120248',
            'password'=>'$2y$10$waS8Zy1ki865Pe024NbWou7pwTG.naAVi9mreaLDgLJk1oPWv8t/m',
            'email_verified_at'=>'2022-11-20 17:24:32',
        ]);
        UserDetail::factory()->create([
            'username' => 'zinc',
            'profile_image' => 'http://localhost:8000/assets/uploads/default.jpg',
            'account_number' => '20221120488',
            'tac'=> random_int(1000, 9999),
            'tax'=> random_int(1000, 9999),
            'imf'=> random_int(1000, 9999),
            'pound_balance'=> 100000,
            'dollar_balance'=> 100000,
            'euro_balance'=> 100000,
            'account_type' => "Savings Account",
        ]);
        UserDetail::factory()->create([
            'username' => 'vince',
            'profile_image' => 'http://localhost:8000/assets/uploads/default.jpg',
            'account_number' => '20221120248',
            'tac'=> random_int(1000, 9999),
            'tax'=> random_int(1000, 9999),
            'imf'=> random_int(1000, 9999),
            'account_type' => "Savings Account",
        ]);
        Setting::factory()->create([
            'name'=> "site_name",
            'value' => "yourdomain.com",
        ]);
        Setting::factory()->create([
            'name'=> "site_logo",
            'value' => "http://127.0.0.1:8000/logo/logo.png",
        ]);
        Setting::factory()->create([
            'name'=> "site_email",
            'value' => "user@yourdomain.com",
        ]);
        Setting::factory()->create([
            'name'=> "local_transfer_charge",
            'value' => "0.10",
        ]);
        Setting::factory()->create([
            'name'=> "international_transfer_charge",
            'value' => "0.10",
        ]);
        Setting::factory()->create([
            'name'=> "exchange_fee",
            'value' => "0.10",
        ]);
        
    }
}
