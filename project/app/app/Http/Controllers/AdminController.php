<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    // get all users and movies
    function showUsersAndMovies()
    {
        $users = User::all(); // paginate(5);
        $movies = Movie::all(); //paginate(5);
        return view('admin.admin-main', compact('users',  'movies')); // does not work with collections 
    }
}
