<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function getAllMovies()
    {
        $movies = Movie::get();
    }

    public function getMovie($id)
    {
        $movie = Movie::find($id);
        return view('movie', ['movie' => $movie]);
    }
}
