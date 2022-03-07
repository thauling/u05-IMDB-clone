<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    // get all users and movies
    function showUsersAndMovies()
    {
        $users =  User::orderBy('name')->paginate(5); 
        $movies = Movie::orderBy('title')->paginate(5);
        $reviews = Review::latest()->paginate(5);
        $usercount = User::count();
        $moviecount = Movie::count();
        $reviewcount = Review::count();
        $allUsers = User::pluck('id', 'name')->all();
        $allMovies = Movie::pluck('id', 'title')->all();
       
        return view('admin.admin-main', compact('users',  'movies', 'reviews', 'usercount', 'moviecount', 'reviewcount', 'allUsers', 'allMovies')); 
    }

   
}


