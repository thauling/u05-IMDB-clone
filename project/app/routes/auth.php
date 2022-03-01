<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UploadImageController; //could move funcs to AdminController but this way perhaps better for reusability

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
  // ADMIN

    Route::get('/upload-image', [UploadImageController::class, 'index']); 
    Route::get('/admin-main', [AdminController::class, 'showUsersAndMovies']); // redirected to from UserController methods, no direct access implemented
    Route::view('/datavis', 'datavis');
  
// USER
    Route::view('/edit-user', 'admin.edit-user');
    Route::post('/store-user', [UserController::class, 'store']); 
    Route::post('/edit-user/{id}', [UserController::class, 'edit']); //called by admin-main search form
    Route::get('/search-user', [UserController::class, 'search']); //called by admin-main search form
    Route::put('/update-user/{id}', [UserController::class, 'update']); //called by admin-edit form
    Route::delete('/destroy-user/{id}', [UserController::class, 'destroy']);

// MOVIE
  
    Route::view('/movie-cast', 'admin.movie-cast');
    Route::view('/movie-images', 'admin.movie-images');
    Route::get('/search-movie', [MovieController::class, 'Search']); 
    Route::get('/admin-search-movie', [MovieController::class, 'adminSearchMovie']); 
    //Route::post('/movies/{movie}/edit', [MovieController::class, 'edit']);
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit']);

    Route::post('/store-movie', [MovieController::class, 'store']); //c
    Route::post('/movies/{movie}/update', [MovieController::class, 'updateMovie']);
   
   // Route::post('/movies/new/create', [MovieController::class, 'postMovie']);
  

    Route::put('/update-movie/{id}', [MovieController::class, 'update']); //
  

    Route::delete('/movies/{movie}/delete', [MovieController::class, 'destroy']);
    Route::delete('/destroy-movie/{id}', [MovieController::class, 'destroy']);
  

    // MOVIE watchlist
    Route::get('/user/watchlist/add/{movie}', [UserController::class, 'updateWatchlist']);
    Route::get('/user/watchlist/remove/{movie}', [UserController::class, 'removeFromWatchlist']);

    //REVIEW 
    Route::get('/edit-review/{id}', [ReviewController::class, 'edit']);
    Route::post('/store-review', [ReviewController::class, 'store']);
    Route::put('/update-review/{id}', [ReviewController::class, 'update']);


    // BREEZE
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
