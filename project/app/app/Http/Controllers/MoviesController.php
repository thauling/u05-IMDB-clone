<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function getAllMovies()
    {
        $movies = Movie::get();
        
        return $movies;
    }

    public function getMovie($id)
    {
        $movie = Movie::find($id);
        return view('movie', ['movie' => $movie]);
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
}
