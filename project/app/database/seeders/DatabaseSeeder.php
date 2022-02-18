<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
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
        User::truncate();
        Movie::truncate();

        User::factory(10)->create();

        Movie::create([
            'title' => 'Lord of the Rings',
            'genre' => 'fantasy',
            'cast' => [
                "Elijah Wood", 
                "Orlando Bloom",
                "Viggo Mortensen", 
                "Cate Blanchett", 
                "Liv Tyler" 
            ],
            'abstract' => 'Lorem ipsum dolor sit amet.',
            'avg_rating' => 5.0,
        ]);

        Movie::create([
            'title' => 'Cloud Atlas',
            'genre' => 'drama',
            'cast' => ["Tom Hanks"],
            'abstract' => 'Lorem ipsum dolor sit amet.',
            'avg_rating' => 3.2
        ]);
    }
}
