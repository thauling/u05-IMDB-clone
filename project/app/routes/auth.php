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
use App\Http\Controllers\UploadImageController; 


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
    Route::get('/admin-main', [AdminController::class, 'showUsersAndMovies']);
  
// USER
    Route::get('/user/upload-image', [UploadImageController::class, 'index']); 
    Route::post('save', [UploadImageController::class, 'save']);
    Route::delete('/delete-image/{id}', [UploadImageController::class, 'delete']);
    Route::view('/edit-user', 'admin.edit-user');
    Route::post('/store-user', [UserController::class, 'store']); 
    Route::get('/edit-user/{id}', [UserController::class, 'edit']); 
    Route::get('/show-user/{id}', [UserController::class, 'showWatchlist']); 
    Route::get('/search-user', [UserController::class, 'search']); 
    Route::put('/update-user/{id}', [UserController::class, 'update']);
    Route::delete('/destroy-user/{id}', [UserController::class, 'destroy']);
    Route::get('/userpage', [UserController::class, 'showWatchlist']);


// MOVIE
  
    Route::view('/movie-cast', 'admin.movie-cast');
    Route::view('/movie-images', 'admin.movie-images');
 
    Route::get('/admin-search-movie', [MovieController::class, 'adminSearchMovie']); 

    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit']);

    Route::post('/store-movie', [MovieController::class, 'store']); 
    Route::post('/movies/{movie}/update', [MovieController::class, 'updateMovie']);
   
    Route::put('/update-movie/{id}', [MovieController::class, 'update']); 
  
    Route::delete('/destroy-movie/{id}', [MovieController::class, 'destroy']);
  

    // MOVIE watchlist
    Route::get('/user/watchlist/add/{movie}', [UserController::class, 'updateWatchlist']);
    Route::get('/user/watchlist/remove/{movie}', [UserController::class, 'removeFromWatchlist']);

    //REVIEW 
    Route::get('/userratings/edit-review/{id}', [ReviewController::class, 'edit']);
    Route::get('/edit-review/{id}', [ReviewController::class, 'editApprove']); 
    Route::post('/store-review', [ReviewController::class, 'store']);
    Route::put('/update-review/{id}', [ReviewController::class, 'update']);
    Route::get('/userratings/{id}', [ReviewController::class, 'showUserRatings']);
    Route::put('/update-approve-review/{id}', [ReviewController::class, 'updateApprove']);
    Route::delete('/destroy-review/{id}', [ReviewController::class, 'destroy']); 
    Route::get('/delete-review/{id}', [ReviewController::class, 'destroy']);  
    Route::get('/admin-search-review', [ReviewController::class, 'adminSearchReview']); 

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

    Route::put('user/update-settings/', [UserController::class, 'updateSettings']);
    
    Route::get('user/user-settings', [UserController::class, 'settings']);

});
