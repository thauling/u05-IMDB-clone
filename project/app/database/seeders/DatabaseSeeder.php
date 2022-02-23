<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
        User::truncate();
        Movie::truncate();

        User::factory(10)->create();

        Movie::create([
            'title' => 'Lord of the Rings',
            'genre' => 'Fantasy',
            'cast' => [
                "Elijah Wood", 
                "Orlando Bloom", 
                "Viggo Mortensen", 
                "Cate Blanchett", 
                "Liv Tyler"
            ],
            'abstract' => 'Lorem ipsum dolor sit amet...',
            'urls_images' => [
                "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages-na.ssl-images-amazon.com%2Fimages%2FS%2Fpv-target-images%2F63006f8c3192e6f732b9f699f5ed368fb557e6742ca8c01209fef0c046d91113._RI_V_TTW_.jpg&f=1&nofb=1"
            ],
            'avg_rating' => 5.00,
        ]);

        Movie::create([
            'title' => 'Cloud Atlas',
            'genre' => 'Drama',
            'cast' => [
                "Tom Hanks"
            ],
            'abstract' => 'Lorem ipsum dolor sit amet...',
            'urls_images' => [
                "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2F3.bp.blogspot.com%2F-T_Hhe1Slxow%2FUSGhQlxdLhI%2FAAAAAAAAGH4%2FecjOXlNXIlI%2Fs1600%2FCloud%2BAtlas%2B2012%2Bfilm%2Bmovie%2Bposter%2Blarge.jpg&f=1&nofb=1"
            ],
            'avg_rating' => 3.20,
        ]);

        Movie::create([
            'title' => 'Harry Potter and the So and So',
            'genre' => 'Fantasy',
            'cast' => [
                "Daniel Radcliffe", 
                "Emma Watson", 
                "Rupert Grint"
            ],
            'abstract' => 'Lorem ipsum dolor sit amet...',
            'urls_images' => [
                "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.testedich.de%2Fquiz58%2Fpicture%2Fpic_1545067980_5.jpg&f=1&nofb=1"
            ],
            'avg_rating' => 5.00,
        ]);

        Movie::create([
            'title' => "C'mon C'mon ",
            'genre' => 'Drama',
            'cast' => [
                "Joaquin Phoenix", 
                "Woody Norman", 
                "Gaby Hoffmann"
            ],
            'abstract' => 'Lorem ipsum dolor sit amet...',
            'urls_images' => [
                "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fd32qys9a6wm9no.cloudfront.net%2Fimages%2Fmovies%2Fposter%2F36%2Fcf00d6faf47fd9529b237d42de182a44_original.jpg%3Ft%3D1629342091&f=1&nofb=1"
            ],
            'avg_rating' => 5.00,
        ]);

        Movie::create([
            'title' => "Star Wars",
            'genre' => 'Science Fiction',
            'cast' => [
                "Some One", 
                "Another One", 
                "Some Person", 
                "Any Body"
            ],
            'abstract' => 'Lorem ipsum dolor sit amet...',
            'urls_images' => [
                "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Famc-theatres-res.cloudinary.com%2Fv1594744342%2Famc-cdn%2Fproduction%2F2%2Fmovies%2F64800%2F64751%2FPosterDynamic%2F109030.jpg&f=1&nofb=1"
            ],
            'avg_rating' => 5.00,
        ]);
    }
}
