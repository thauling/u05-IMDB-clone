<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::latest()->get();
        //$users = User::all();  // same as 'get()' ?
        return view('admin.admin-main', ['moviess' => $movies]); //->paginate(2);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //dd($request);
        if (Auth::check() && Auth::user()->is_admin) :
            //dd(request());
            $request["is_admin"] = $request["is_admin"] ? 1 : 0; //convert checkbox value to tinyint, 1 or 0
            $attributes = request()->validate([
                'title' => ['required'],
                'genre' => ['required'],
                //'cast' => ['required'],
                'abstract' => ['required'],
                //'urls_images' => ['required'],
                'url_trailer' => ['required'],
            ]);

            dd('validation success'); //for debugging, to see if store method is called
            Movie::create($attributes);
            // Movie::create([
            //     'title' => $attributes['title'],
            //     'genre' => $attributes['genre'],
            //    // 'cast' => json_encode($attributes['cast']), //json_encode(array($attributes['cast'])),
            //     'abstract' => $attributes['abstract'],
            //     //'urls_images' => json_encode($attributes['urls_images']),
            //     'url_trailer' => $attributes['url_trailer']
                
            // ]);


            session()->flash('success', 'Movie added');
        else :
            dd('Auth problem');
        endif;
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::find($id);  
        //dd($user);
        return view('admin.movie-cast', ['movie' => $movie]);
    }

     
    public function search(Request $request) // and/ or $name
    {
        
        $query = $request->input('query');
        //dd($query);
        $movie = Movie::where('title', 'like', '%' . $query . '%')->orWhere('abstract', 'like', '%' . $query . '%')->first(); // '%' are regex placeholders, 

        // grouped orWhere clause should be used instead according to docs but throws error
        // $user = User::where (function ($query) 
        // {$query->where('email', 'like', '%' . $query . '%')
        //     ->orWhere('name', 'like', '%' . $query . '%');})
        // ->first(); 

        return view('admin.movie-cast', ['movie' => $movie]);
    }

    
    public function update(Request $request, $id)
    {
        //
        $movie = Movie::find($id);
        $movie->update($request->all());
        
       // return redirect('dashboard-admin');
        return redirect('admin-main');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Movie::destroy($id);
        session()->flash('success', 'Movie deleted');
        //return redirect()->back(); //back() redirects to previous page
        return redirect()->back();
    }

}


