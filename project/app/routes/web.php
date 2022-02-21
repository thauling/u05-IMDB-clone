<?php

use App\Http\Controllers\ContentsArrController;
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
    return view('landing', [
        'movies' => Movie::all()
    ]);
});

Route::get('/search', function() {
    return view('search', [
        'movies' => Movie::all()
    ]);
});
