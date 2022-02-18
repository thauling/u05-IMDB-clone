<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            'title' => Str::random(10),
            'genre' => Str::random(7),
            'cast' => [Str::random(10), Str::random(5), Str::random(7)],
            'abstract' => Str::random(20),
            'urls_images' => [Str::random(10), Str::random(5)],
            'url_trailer' => Str::random(30),
            'avg_rating' => rand(0, 10) / 10
        ]);
    }
}
