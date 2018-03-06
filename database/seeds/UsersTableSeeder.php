<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the users table
        User::truncate();

        $faker = \Faker\Factory::create();

        // Create and hash the password for all the users
        $password = Hash::make('laravel');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => $password
        ])->createToken('MyApp');

        // Add 10 more fake users to the users table
        for($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password
            ])->createToken('MyApp');
        }
    }
}
