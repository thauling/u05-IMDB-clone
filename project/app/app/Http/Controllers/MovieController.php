<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
// this to access/ store images 
use Image;
use Storage;


class MovieController extends Controller
{
    public function getAllMovies()
    {
        $movies = Movie::all();

        $alteredMovies = [];

        foreach ($movies as $movie) {
            $imgsToArray = json_decode($movie->urls_images);

            $alteredMovie = [
                'id' => $movie->id,
                'title' => $movie->title,
                'genre' => $movie->genre,
                'cast' => json_decode($movie->cast),
                'abstract' => $movie->abstract,
                'urls_images' => "https://image.tmdb.org/t/p/w1280$imgsToArray[0]",
                'url_trailer' => $movie->url_trailer,
                'avg_rating' => $movie->avg_rating,
                'released' => $movie->released
            ];

            array_push($alteredMovies, $alteredMovie);
        }

        return view('landing', [
            'movies' => $alteredMovies
        ]);
    }

    public function getMovie($id)
    {
        $movie = Movie::find($id);

        $imgsToArray = json_decode($movie->urls_images);

        $alteredMovie = [
            'id' => $movie->id,
            'title' => $movie->title,
            'genre' => $movie->genre,
            'cast' => json_decode($movie->cast),
            'abstract' => $movie->abstract,
            'urls_images' => "https://image.tmdb.org/t/p/w1280$imgsToArray[0]",
            'url_trailer' => $movie->url_trailer,
            'avg_rating' => $movie->avg_rating,
            'released' => $movie->released
        ];

        $reviews = Review::where('movie_id', $id)->get()->toArray();
        $alteredReviews = [];

        // need to check that user (still) exists - she/he might have been deleted
        foreach ($reviews as $review) {
            if (User::find($review['user_id'])) {
                $user = User::find($review['user_id'])['name'];
            } else {
                $user = 'anonymous';
            };


            $alteredReview = [
                "id" => $review['id'],
                "title" => $review['title'],
                "review_content" => $review['review_content'],
                "review_rating" => $review['review_rating'],
                "user_id" => $review['user_id'],
                "user_name" => $user, //$user['name'],
                "movie_id" => $review['movie_id'],
                "is_approved" => $review['is_approved'],
                "created_at" => $review['created_at'],
                "updated_at" => $review['updated_at']
            ];

            array_push($alteredReviews, $alteredReview);
        }
        return view('movie', [
            'movie' => $alteredMovie,
            'reviews' => $alteredReviews,
        ]);
    }

    public function postMovie(Request $req)
    {
        // Needs validator

        $movie = Movie::create([ // How to protect from injections? Look this up
            'title' => $req->title,
            'genre' => $req->genre,
            'cast' => json_encode(array($req->cast)), // Depending on how the user gets to submit the cast, explode by ","?
            'abstract' => $req->abstract,
            'urls_images' => json_encode(array($req->images)), // How does the user get to submit img paths?
            'url_trailer' => $req->trailer, // This should be the movie id on YT, not the entire url
            'avg_rating' => $req->rating, // Should not be manually submitted?
            'released' => (int)$req->released
        ]);

        return view('movie', ['movie' => $movie]);
    }

    // public function deleteMovie($id)
    // {
    //     Movie::destroy($id);
    //     return redirect('dashboard-admin'); // Correct redirect? Since only admins are supposed to be able to delete?
    // }

    // public function editMovie($id)
    // {   
    //     // Needs validator
    //     $movie = Movie::find($id);

    //     $imgsToArray = json_decode($movie->urls_images); 

    //     $alteredMovie = [
    //         'id' => $movie->id,
    //         'title' => $movie->title,
    //         'genre' => $movie->genre,
    //         'cast' => json_decode($movie->cast),
    //         'abstract' => $movie->abstract,
    //         'urls_images' => "https://image.tmdb.org/t/p/w1280$imgsToArray[0]",
    //         'url_trailer' => $movie->url_trailer,
    //         'avg_rating' => $movie->avg_rating,
    //         'released' => $movie->released
    //     ];

    //     return view('edit-movie', ['movie' => $alteredMovie]);

    // }

    public function updateMovie(Request $req, $id)
    {
        $movie = Movie::where('id', $id)->update([
            'title' => $req->title,
            'genre' => $req->genre,
            'cast' => json_encode(array($req->cast)),
            'abstract' => $req->abstract,
            'url_trailer' => $req->url_trailer,
            'released' => (int)$req->released
        ]);

        return view('movie', ['movie' => $movie]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('admin.admin-main', ['moviess' => $movies]);
    }


    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->is_admin) :
            $request["is_admin"] = $request["is_admin"] ? 1 : 0; //convert checkbox value to tinyint, 1 or 0
            $attributes = request()->validate([
                'title' => ['required'],
                'genre' => ['required'],
                'released' => ['required'],
                'abstract' => ['required'],
                'url_trailer' => ['required'],
            ]);

            Movie::create([
                'title' => $attributes['title'],
                'genre' => $attributes['genre'],
                'abstract' => $attributes['abstract'],
                'url_trailer' => $attributes['url_trailer'], 
                'released' => (int)$attributes['released']
            ]);

            session()->flash('success', 'Movie added');
        else :
            session()->flash('success', 'Auth problem');
        endif;
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::find($id);
        //dd($user);
        return view('admin.movie-cast', ['movie' => $movie]);
    }



    // updates input from movie-cast, Edit Movie Info (Title, Abstract, Genre) 
    public function update(Request $req, $id)
    {
        $movie = Movie::find($id);
        //$movie->update($request->all());
        $castArr = [];

        for ($i = 0; $i < count($req->cast); $i++) {
            $castArr[] = array_values(($req->cast)[$i]);
        };
        $flattened_cast = json_encode(array_values(array_reduce($castArr, 'array_merge', [])));

        $movie->update([
            'title' => $req->title,
            'genre' => $req->genre,
            'cast' => $flattened_cast,
            'abstract' => $req->abstract,
            'url_trailer' => $req->url_trailer,
            'released' => (int)$req->released
        ]);
        session()->flash('success', 'Movie updated');

        return redirect()->back();
    }


    public function destroy($id)
    {
        //
        Movie::destroy($id);
        session()->flash('success', 'Movie deleted');
        //return redirect()->back(); //back() redirects to previous page
        return redirect()->back();
    }



    // Search functionality for movies
    // The code works but is overly complicated
    public function movieSearch(Request $request) // and/ or $name
    {
        $movies = Movie::all();
        $query = $request->input('s');
        $results = [];
        $actors = [];

        foreach ($movies as $movie) {

            foreach (json_decode($movie->cast) as $actor) {

                if (Str::contains(strtolower($actor), strtolower($query))) {
                    array_push($actors, $actor);
                }
            }

            if (
                Str::contains(strtolower($movie->title), strtolower($query)) ||
                Str::contains(strtolower($movie->genre), strtolower($query)) || !empty($actors)
            ) {

                array_push($results, $movie);
            }

            $actors = [];
        }

        if ($query === null || $query === '') {
            $results = $movies;
        }

        // ↓↓↓↓↓↓ DOESNT WORK ↓↓↓↓↓↓↓
        // $results = Movie::where('title', 'like', '%' . $query . '%')
        //                     ->orWhere('genre', 'like', '%' . $query . '%')
        //                     ->orWhere('cast', 'like', '%' . $query . '%')
        //                     ->get(); 
        // ↑↑↑↑↑↑ DOESNT WORK ↑↑↑↑↑↑↑

        return view('landing', ['results' => $results]);
    }
    // admin movie search  
    public function adminSearchMovie(Request $request) // and/ or $name
    {

        $query = $request->input('query');
        //dd($query);
        $movie = Movie::where('title', 'like', '%' . $query . '%')
            ->orWhere('abstract', 'like', '%' . $query . '%')->first(); // '%' are regex placeholders, 


        return view('admin.movie-cast', ['movie' => $movie]);
    }

    public function getByGenre($genre)
    {
        return view('genre', [
            'movies' => Movie::where('genre', $genre)->orderBy('avg_rating', 'desc')->get(),
            'genre' => $genre
        ]);
    }
}
