<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }

    public function search(Request $request) // and/ or $name
    {
        $movies = Movie::all();
        $query = $request->input('s');
        $results = [];
        $actors = [];

        foreach($movies as $movie) {

           foreach (json_decode($movie->cast) as $actor) {
               
                if (Str::contains(strtolower($actor), strtolower($query))) {
                array_push($actors, $actor);
                }
            }
                   
            if (Str::contains(strtolower($movie->title), strtolower($query)) || 
            Str::contains(strtolower($movie->genre), strtolower($query)) || !empty($actors)) {
                
                array_push($results, $movie);
            }
            
            $actors = [];
        }

        if($query === null || $query === '') {
            $results = $movies;
        }


        // $results = Movie::where('title', 'like', '%' . $query . '%')
        //                     ->orWhere('genre', 'like', '%' . $query . '%')
        //                     ->orWhere('cast', 'like', '%' . $query . '%')
        //                     ->get(); 

        return view('landing', ['results' => $results]);
    }
}
