<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;

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

    Route::get('search-movie', [MovieController::class, 'search']);

});

Route::middleware('auth')->group(function () {
    //Thomas
    // need extra 'is_admin check'  
    Route::get('admin-main', [AdminController::class, 'showUsersAndMovies']); // redirected to from UserController methods, no direct access implemented
    //Route::get('admin-main', [UserController::class, 'index']);
    // show auth user stats
     Route::view('/datavis', 'datavis');
    // User CRUD
    // add a new user to the db
    // could also group these: 
    // Route::controller(OrderController::class)->group(function () {
    //     Route::get('/orders/{id}', 'show');
    //     Route::post('/orders', 'store');
    // });
    // and prefix all admin routes
    // Route::prefix('admin')->group(function () {
    //     Route::get('/users', function () {
    //         // Matches The "/admin/users" URL
    //     });
    // });
    
    Route::post('store-user', [UserController::class, 'store']); //called by admin-main create user/ admin form
    //edit, search and update user details, e.g. role
    Route::view('edit-user', 'admin.edit-user'); 
    Route::post('edit-user/{id}', [UserController::class, 'edit']); //called by admin-main search form
    Route::get('search-user', [UserController::class, 'search']); //called by admin-main search form
    Route::put('update-user/{id}', [UserController::class, 'update']); //called by admin-edit form
    //remove user
    Route::delete('destroy-user/{id}', [UserController::class, 'destroy']);
    // Movie CRUD
     // add a new movie to the db
    Route::post('store-movie', [MovieController::class, 'store']); //c
    // show cast and images forms
    Route::view('movie-cast', 'admin.movie-cast');
    Route::view('movie-images', 'admin.movie-images');  
    Route::post('edit-movie/{id}', [MovieController::class, 'edit']);
    Route::get('search-movie', [MovieController::class, 'search']); //
    Route::put('update-movie/{id}', [MovieController::class, 'update']); //
    //remove user
    Route::delete('destroy-movie/{id}', [MovieController::class, 'destroy']);
    //Thomas end

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
