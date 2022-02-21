<?php

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



//Route::post('store-register', [UserController::class, 'register']);


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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
