<?php

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

Route::get('/test', function () {
    return view('test');  
});

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
