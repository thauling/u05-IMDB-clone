<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ContentsArrController;
use App\Http\Controllers\UserController;
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

/// Thomas start
//public: landing page, register, login
Route::view('/home', 'home');
Route::view('/register', 'register');
Route::view('/login', 'login');


//register new user
Route::post('/register-user', [UserController::class, 'register']);

//login existing user
Route::post('login-user', [UserController::class, 'login']);

// show stats
Route::view('/datavis', 'datavis');

// admin dashboard routes
// show user details
//Route::get('dashboard-admin', [UserController::class, 'index']);
// Route::get('dashboard-admin/{id}', [UserController::class, 'show']); 

// // User CRUD
// // add a new user to the db
// Route::post('store-user', [UserController::class, 'store']);
// //update user details, e.g. role
// Route::put('dashboard-admin/{id}', [UserController::class, 'update']);
// //remove user
// Route::delete('dashboard-admin/{id}', [UserController::class, 'delete']);
// // search for a user by email
// Route::get('dashboard-admin/{email}', [UserController::class, 'search']);
// Thomas end

// Landing page start
Route::get('/', function () {
    return view('landing', [
        'movies' => Movie::all()
    ]);
});
// Landing page end

// start User page routes
Route::get('/userpage', function () {
    return view('userpage');
});

Route::get('/userpage', function () {
    return view('userpage');
});
// end user page routes


// Movie routes
Route::get('/movies/{movie}', [MoviesController::class, 'getMovie']);
Route::get('/search', function() {
    return view('search', [
        'movies' => Movie::all()
    ]);
});
// Review CRUD
Route::get('reviews', [ReviewController::class, 'index']);
Route::post('store-review', [ReviewController::class, 'store']);
Route::get('review/{id}', [ReviewController::class, 'show']);
Route::get('edit-review/{id}', [ReviewController::class, 'edit']);
Route::put('update-review/{id}', [ReviewController::class, 'update']);
Route::get('reviews/create', function(){
    return view('reviews/create');
});
// Review end

// Breeze start
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Breeze end
