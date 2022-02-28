<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ContentsArrController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadImageController;
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

/// Thomas start
//public: landing page, register, login
Route::view('/test', 'test');
Route::view('/home', 'home');
Route::view('/register', 'register');
Route::view('/login', 'login');


//register new user
Route::post('/register-user', [UserController::class, 'register']);

//login existing user
Route::post('login-user', [UserController::class, 'login']);

// // show admin stats
// Route::view('/datavis', 'datavis');



// start User page routes
Route::get('/userpage', function () {
    return view('userpage');
});

Route::get('/userpage', function () {
    return view('userpage');
});
// end user page routes


// Movie routes
Route::get('/movie', [MoviesController::class, 'getMovie']);
Route::get('/movies/{movie}', [MoviesController::class, 'getMovie']);
Route::get('/search', function() {
    return view('search', [
        'movies' => Movie::all()
    ]);
});

// Image CRUD
Route::post('save', [UploadImageController::class, 'save']);
// Route::get('reviews', [ReviewController::class, 'index']);
// Route::post('store-review', [ReviewController::class, 'store']);
// Route::get('review/{id}', [ReviewController::class, 'show']);
// Route::get('reviews/create', [ReviewController::class, 'create']);
// Movies end

// Breeze start
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('landing', [
//         'movies' => Movie::orderBy('avg_rating', 'desc')->get()
//     ]);
// })->middleware(['auth'])->name('landing');

require __DIR__.'/auth.php';

// Breeze end

// Landing page start
Route::get('/', function () {
    return view('landing', [
        'movies' => Movie::orderBy('avg_rating', 'desc')->get()
    ]);
});
// Landing page end
