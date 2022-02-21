<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// public routes: anyone is allowed to do this:
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::get('/movies/{name}', [MovieController::class, 'search']); //consider other search params (actors, genre etc)
// protected routes: only allow authenticated admins to do the following:
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     //for movies
//     Route::post('/movies', [MovieController::class, 'store']);
//     Route::put('/movies/{id}', [MovieController::class, 'update']);
//     Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
//    //for users

// });
