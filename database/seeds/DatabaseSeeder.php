<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // Disable foreign key check for this connection before seeding
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);

        // Again enable foreign key checks after seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
