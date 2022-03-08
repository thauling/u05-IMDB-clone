<?php

use App\Http\Controllers\MovieController;
// use App\Http\Controllers\ContentsArrController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\ReviewController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;


// USER 
// Landing page start
Route::get('/', function () {
    return view('landing', [
        'movies' => Movie::orderBy('avg_rating', 'desc')->get()
    ]);
});


// MOVIE 
Route::get('/movies', [MovieController::class, 'getAllMovies']);
Route::get('/search', function () {
    return view('search', [
        'movies' => Movie::all()
    ]);
});

Route::get('/movies/{movie}', [MovieController::class, 'getMovie']);


// REVIEW

Route::get('review/{id}', [ReviewController::class, 'show']);

Route::get('/search-movie', [MovieController::class, 'movieSearch']);

Route::get('/movies/genre/{slug}', [MovieController::class, 'getByGenre']);


require __DIR__ . '/auth.php';
