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
    //Thomas
    Route::view('edit-user', 'admin.edit-user'); 
    // show auth user stats
    Route::view('/datavis', 'datavis');
    // need extra 'is_admin check'  
    Route::get('dashboard-admin', [UserController::class, 'index']); // redirected to from UserController methods, no direct access implemented
    // User CRUD
    // add a new user to the db
    Route::post('store-user', [UserController::class, 'store']); //called by admin-main create user/ admin form
    //edit, search and update user details, e.g. role
    Route::post('edit-user/{id}', [UserController::class, 'edit']); //called by admin-main search form
    Route::get('search-user', [UserController::class, 'search']); //called by admin-main search form
    Route::put('update-user/{id}', [UserController::class, 'update']); //called by admin-edit form
    //remove user
    Route::delete('destroy-user/{id}', [UserController::class, 'destroy']);
    // // search for a user by email
    // Route::get('dashboard-admin/{email}', [UserController::class, 'search']);
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
