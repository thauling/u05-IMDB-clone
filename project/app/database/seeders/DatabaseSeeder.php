<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
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
<<<<<<< HEAD
        User::factory(10)->create();
        Review::factory(20)->create();
        // Movie::factory(100)->create();

        

        /**** SHOULD THESE API REQUESTS BE SOMEWHERE ELSE? IN THE MOVIE FACTORY FILE? ****/
        // Get popular movies from TMDB
        $movies = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US&page=1');
        $moviesToArray = json_decode($movies); // Convert to array

        // Genres are defined as a seperate endpoint and are refered to by their ID in the movie object
        function getGenre ($id) { // Get the genre by the genre ID in the movie object
            $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=87a6bee8df47d296511c8924683d6ecf&language=en-US');
            $genresToArray = json_decode($genres);

            foreach ($genresToArray->genres as $genre) { // Loop through all genres to find the match, return the genre name
                if ($genre->id == $id) {
                    return $genre->name;
                }
            }
        }

        // Trailers are defined as a seperate endpoint
        function getTrailer ($id) { // Get the trailer youtube key with the movie ID
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

            Movie::create([ // Seed movies table with the API responses
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

=======
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
>>>>>>> 866b18aac92d5a7168d44ae6c76ebc906084976d
    }
}
