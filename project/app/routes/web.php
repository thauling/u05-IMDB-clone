<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ContentsArrController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\ReviewController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// USER 
// Landing page start
Route::get('/', function () {
    return view('landing', [
        'movies' => Movie::orderBy('avg_rating', 'desc')->get()
    ]);


});

// change to Route::get('/', [MovieController::class, 'getAllMovies']); //do orderBy(), [''] notation in blade.php

Route::get('/userpage', function () {
    return view('userpage');
});

/// watchlist
Route::get('user/watchlist/add/{movie}', [UserController::class, 'updateWatchlist']);
Route::get('user/watchlist/remove/{movie}', [UserController::class, 'removeFromWatchlist']);

// MOVIE 
Route::get('/movies', [MovieController::class, 'getAllMovies']);
Route::get('/search', function() {
    return view('search', [
        'movies' => Movie::all()
    ]);
});

Route::get('/movies/{movie}', [MovieController::class, 'getMovie']);
Route::post('/movies/new/create', [MovieController::class, 'postMovie']);
Route::delete('/movies/{movie}/delete', [MovieController::class, 'deleteMovie']);
Route::get('/movies/{movie}/edit', [MovieController::class, 'editMovie']);
Route::post('/movies/{movie}/update', [MovieController::class, 'updateMovie']);


// REVIEW
Route::post('store-review', [ReviewController::class, 'store']);
Route::get('review/{id}', [ReviewController::class, 'show']);
Route::get('edit-review/{id}', [ReviewController::class, 'edit']);
Route::put('update-review/{id}', [ReviewController::class, 'update']);


// BREEZE Auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';




Route::view('/test', 'test'

// DISCARD PILE


);


