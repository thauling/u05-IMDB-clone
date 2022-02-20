<?php

use App\Http\Controllers\MoviesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('test');  
});

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
