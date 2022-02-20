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
        User::factory(10)->create();
        Review::factory(20)->create();
        // Movie::factory(100)->create();

        

        $movies = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US&page=1');
        $moviesToArray = json_decode($movies);

        function getGenre ($id) {
            $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US');
            $genresToArray = json_decode($genres);

            foreach ($genresToArray->genres as $genre) {
                if ($genre->id == $id) {
                    return $genre->name;
                }
            }
        }

        function getTrailer ($id) {
            $trailer = Http::get("https://api.themoviedb.org/3/movie/$id/videos?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US");
            $trailerToArray = json_decode($trailer);

            if (!$trailerToArray->results == []) {
                
                $trailerId = $trailerToArray->results[0]->key;

                return "https://www.youtube.com/embed/$trailerId";
            } else {
                return "";
            }
            
        }

        foreach ($moviesToArray->results as $movie) {

            $actors = Http::get("https://api.themoviedb.org/3/movie/$movie->id/credits?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US");
            $actorsToArray = json_decode($actors);

            Movie::create([
                'title' => $movie->original_title,
                'genre' => getGenre($movie->genre_ids[0]),
                'cast' => json_encode(array($actorsToArray->cast[0]->name, $actorsToArray->cast[1]->name, $actorsToArray->cast[2]->name)),
                'abstract' => $movie->overview,
                'urls_images' => json_encode(array($movie->poster_path)),
                'url_trailer' => getTrailer($movie->id),
                'avg_rating' => $movie->vote_average,
                'released' => (int)substr($movie->release_date, 0, 4)
            ]);
        }

    }
}
