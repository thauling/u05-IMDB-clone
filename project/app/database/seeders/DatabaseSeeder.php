<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create(); //10 = 10 rows I guess?
        Movie::factory(100)->create();
        Review::factory(20)->create();

        DB::table('movies')->insert([
            'title' => 'The Book of Boba Fett',
            'genre' => 'Adventure',
            'cast' => json_encode(array('Temuera Morrison', 'Ming-Na Wen', 'Frank Trigg')),
            'abstract' => "Bounty hunter Boba Fett & mercenary Fennec Shand navigate the underworld when they return to Tatooine to claim Jabba the Hutt's old turf.",
            'urls_images' => json_encode(array(
                'https://www.google.com/url?sa=i&url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2FThe_Book_of_Boba_Fett&psig=AOvVaw2iRHW1NsYyeIEhhU0vCZm-&ust=1645378423560000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCOCB8remjPYCFQAAAAAdAAAAABAD', 
                'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.imdb.com%2Ftitle%2Ftt13668894%2F&psig=AOvVaw2iRHW1NsYyeIEhhU0vCZm-&ust=1645378423560000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCOCB8remjPYCFQAAAAAdAAAAABAJ'
            )), //file >
            'url_trailer' => 'https://youtu.be/rOJ1cw6mohw',
            'avg_rating' => 4, // 1 - 5 to avoid div by 0
            'released' => 2021
        ]);
    }
}
