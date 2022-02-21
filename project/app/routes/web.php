<?php

<<<<<<< HEAD
use App\Http\Controllers\MoviesController;
=======
use App\Http\Controllers\ContentsArrController;
>>>>>>> 866b18aac92d5a7168d44ae6c76ebc906084976d
use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

/// Thomas
//public: landing page, register, login
Route::view('/home', 'home');
Route::view('/register', 'register');
Route::view('/login', 'login');


//register new user
Route::post('/register-user', [UserController::class, 'register']);

//login existing user
Route::post('login-user', [UserController::class, 'login']);



<<<<<<< HEAD
//Route::post('store-register', [UserController::class, 'register']);

// Movie routes
Route::get('/movies/{movie}', [MoviesController::class, 'getMovie']);

<<<<<<< HEAD
// User routes
Route::get('/userpage', function () {
    return view('userpage');
});
// Admin functionality
Route::get('dashboard', [UserController::class, 'index']);
Route::post('store-user', [UserController::class, 'store']);
Route::post('store-movie', [MovieController::class, 'store']);
=======
// show stats
Route::view('/datavis', 'datavis');

// admin dashboard routes
// show user details
Route::get('dashboard-admin', [UserController::class, 'index']);
Route::get('dashboard-admin/{id}', [UserController::class, 'show']); 

// add a new user to the db
Route::post('store-user', [UserController::class, 'store']);
//update user details, e.g. role
Route::put('dashboard-admin/{id}', [UserController::class, 'update']);
//remove user
Route::delete('dashboard-admin/{id}', [UserController::class, 'delete']);
// search for a user by email
Route::get('dashboard-admin/{email}', [UserController::class, 'search']);
// Thomas end


// Breeze
Route::get('/', function () {
    return view('landing', [
        'movies' => Movie::all()
    ]);
});

Route::get('/search', function() {
    return view('search', [
        'movies' => Movie::all()
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
>>>>>>> 417ac88bdc3d144649a5671abc64f61e9b84a3a6
=======
Route::get('/userpage', function () {
    return view('userpage');
});

Route::get('reviews', [ReviewController::class, 'index']);
Route::post('store-review', [ReviewController::class, 'store']);
Route::get('review/{id}', [ReviewController::class, 'show']);
Route::get('reviews/create', [ReviewController::class, 'create']);

//admin functionality
Route::get('dashboard', [UserController::class, 'index']);
Route::post('store-user', [UserController::class, 'store']);
Route::post('store-movie', [MovieController::class, 'store']);
>>>>>>> d454556f3f5ab73f3d43869dc1c73b6f5417c7ad
