<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the posts table
        Post::truncate();

        $faker = \Faker\Factory::create();

        $users = User::all()->pluck('id')->toArray();

        // Adding 30 fake posts in the table
        for ($i = 0; $i < 30; $i++) {
            Post::create([
                'user_id' => $faker->randomElement($users),
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
