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


// show stats
Route::view('/datavis', 'datavis');

//Route::post('store-movie', [MovieController::class, 'store']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    //protected: logout existing user
    Route::post('/logout', [UserController::class, 'logout']);



    //admin functionality (which of these should move to api.php ?)
    Route::get('dashboard', [UserController::class, 'index']);
    Route::get('dashboard/{id}', [UserController::class, 'show']); // how to set this up? 
    Route::post('store-user', [UserController::class, 'store']);
    //update user details, e.g. role
    Route::put('dashboard/{id}', [UserController::class, 'update']);
    //remove user
    Route::delete('dashboard/{id}', [UserController::class, 'delete']);

    Route::get('dashboard/{email}', [UserController::class, 'search']);


    //for movies (not implemented)
    Route::post('/movies', [MovieController::class, 'store']);
    Route::put('/movies/{id}', [MovieController::class, 'update']);
    Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
    //for users

});
