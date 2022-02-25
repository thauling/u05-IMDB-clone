<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

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

        foreach ($reviews as $review) {

            $user = User::find($review['user_id']);

            $alteredReview = [
                "id" => $review['id'],
                "review_content" => $review['review_content'],
                "review_rating" => $review['review_rating'],
                "user_id" => $review['user_id'],
                "user_name" => $user['name'],
                "movie_id" => $review['movie_id'],
                "created_at" => $review['created_at'],
                "updated_at" => $review['updated_at']
            ];

            array_push($alteredReviews, $alteredReview);
        }

        return view('movie', [
            'movie' => $alteredMovie,
            'reviews' => $alteredReviews
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

    public function deleteMovie($id)
    {
        Movie::destroy($id);
        return redirect('dashboard-admin'); // Correct redirect? Since only admins are supposed to be able to delete?
    }

    public function editMovie(Request $req, $id)
    {   
        // Needs validator
        $movie = Movie::where('id', $id)->update([
            'title' => $req->title,
            'genre' => $req->genre, 
            'cast' => json_encode(array($req->cast)),
            'abstract' => $req->abstract,
            'urls_images' => json_encode(array($req->images)),
            'url_trailer' => $req->trailer,
            'avg_rating' => $req->rating, 
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
