<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create(); //10 = 10 rows I guess
        /* or more specifically:
        
        User::truncate(); //run this first to prevent duplicates 
        $user = User::factory()->create([
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'password' => bcrypt('password')
        ]);

        */
    }
}
