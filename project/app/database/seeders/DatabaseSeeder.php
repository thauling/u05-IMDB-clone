<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Movie;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory(10)->create();

        // DB::table('movies')->insert([
        //     'title' => Str::random(10),
        //     'genre' => Str::random(7),
        //     'cast' => [Str::random(10), Str::random(5), Str::random(7)],
        //     'abstract' => Str::random(20),
        //     'urls_images' => [Str::random(10), Str::random(5)],
        //     'url_trailer' => Str::random(30),
        //     'avg_rating' => rand(0, 10) / 10
        // ]);
        // \App\Models\User::factory(10)->create(); //10 = 10 rows I guess
        /* or more specifically:
        $user = User::factory()->create([
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'password' => bcrypt('password')
        ]);

        */
    }
}
