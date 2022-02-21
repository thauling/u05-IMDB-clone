<?php

use App\Http\Controllers\MoviesController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// all requests that do not require authentication:



//public: landing page, register, login
Route::view('/home', 'home');
Route::view('/register', 'register');
Route::view('/login', 'login');


//register new user
Route::post('/register-user', [UserController::class, 'register']);

//login existing user
Route::post('login-user', [UserController::class, 'login']);



//Route::post('store-register', [UserController::class, 'register']);

// Movie routes
Route::get('/movies/{movie}', [MoviesController::class, 'getMovie']);

// User routes
Route::get('/userpage', function () {
    return view('userpage');
});
// Admin functionality
Route::get('dashboard', [UserController::class, 'index']);
Route::post('store-user', [UserController::class, 'store']);
Route::post('store-movie', [MovieController::class, 'store']);
