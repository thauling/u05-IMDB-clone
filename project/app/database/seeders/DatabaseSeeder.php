<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create random users
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
            ]);
        }

        // Create random reviews
        for ($i = 0; $i < 10; $i++) {
            Review::create([
                'title' => Str::random(10),
                'review_content' => Str::random(100),
                'review_rating' => rand(1, 10),
                'is_approved' => rand(0, 1),
                'user_id' =>  rand(1, 11),
                'movie_id' => rand(1, 20),
            ]);
        }
        // Get popular movies from TMDB
        $movies = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US&page=1');
        $moviesToArray = json_decode($movies); // Convert to array

        // Genres are defined as a seperate endpoint and are refered to by their ID in the movie object
        function getGenre($id)
        { // Get the genre by the genre ID in the movie object
            $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US');
            $genresToArray = json_decode($genres);

            foreach ($genresToArray->genres as $genre) { // Loop through all genres to find the match, return the genre name
                if ($genre->id == $id) {
                    return $genre->name;
                }
            }
        }

        // Trailers are defined as a seperate endpoint
        function getTrailer($id)
        { // Get the trailer youtube key with the movie ID
            $trailer = Http::get("https://api.themoviedb.org/3/movie/$id/videos?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US");
            $trailerToArray = json_decode($trailer);

            if (!$trailerToArray->results == []) { // If results is NOT empty array

                $trailerId = $trailerToArray->results[0]->key;

                return "https://www.youtube.com/embed/$trailerId"; // Return embed url
            } else {
                return "";
            }
        }

        // Loop through API response
        foreach ($moviesToArray->results as $movie) {

            // Actors of a specific movie are defined as a seperate endpoint
            $actors = Http::get("https://api.themoviedb.org/3/movie/$movie->id/credits?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US");
            $actorsToArray = json_decode($actors);

            $imgPath = "https://image.tmdb.org/t/p/w1280$movie->poster_path";

            Movie::create([ // Seed movies table with the API responses
                'title' => $movie->original_title,
                'genre' => getGenre($movie->genre_ids[0]),
                'cast' => json_encode(array($actorsToArray->cast[0]->name, $actorsToArray->cast[1]->name, $actorsToArray->cast[2]->name)),
                'abstract' => $movie->overview,
                'urls_images' => json_encode(array($imgPath)),
                'url_trailer' => getTrailer($movie->id),
                'avg_rating' => $movie->vote_average,
                'released' => (int)substr($movie->release_date, 0, 4)
            ]);
        }

        // User::factory(10)->create();
        // Review::factory(50)->create();

        $movies = Movie::all();

        foreach ($movies as $movie) {
            $reviews = Review::where('movie_id', $movie->id)->get()->toArray();
            $ratings = [];

            if ($reviews) {
                foreach ($reviews as $review) {
                    array_push($ratings, $review['review_rating']);
                }

                $movie->avg_rating = array_sum($ratings) / count($ratings);
                $movie->update();
            }
        }
    }
}
