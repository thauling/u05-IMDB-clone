<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
// this to access/ store images 
use Image;
use Storage;


class MovieController extends Controller
{
    public function getAllMovies()
    {
        $movies = Movie::all();

        $alteredMovies = [];

        foreach ($movies as $movie) {
            $imgsToArray = json_decode($movie->urls_images); 

            $alteredMovie = [
                'id' => $movie->id,
                'title' => $movie->title,
                'genre' => $movie->genre,
                'cast' => json_decode($movie->cast),
                'abstract' => $movie->abstract,
                'urls_images' => "https://image.tmdb.org/t/p/w1280$imgsToArray[0]",
                'url_trailer' => $movie->url_trailer,
                'avg_rating' => $movie->avg_rating,
                'released' => $movie->released
            ];

            array_push($alteredMovies, $alteredMovie);
        }
        
        return view('landing', [
            'movies' => $alteredMovies
        ]);
    }

    public function getMovie($id)
    {
        $movie = Movie::find($id);

        $imgsToArray = json_decode($movie->urls_images); 

        $alteredMovie = [
            'id' => $movie->id,
            'title' => $movie->title,
            'genre' => $movie->genre,
            'cast' => json_decode($movie->cast),
            'abstract' => $movie->abstract,
            'urls_images' => "https://image.tmdb.org/t/p/w1280$imgsToArray[0]",
            'url_trailer' => $movie->url_trailer,
            'avg_rating' => $movie->avg_rating,
            'released' => $movie->released
        ];

        $reviews = Review::where('movie_id', $id)->get()->toArray();
        $alteredReviews = [];

        foreach ($reviews as $review) {

            $user = User::find($review['user_id']);

            $alteredReview = [
                "id" => $review['id'],
                "title" =>$review['title'],
                "review_content" => $review['review_content'],
                "review_rating" => $review['review_rating'],
                "user_id" => $review['user_id'],
                "user_name" => $user['name'],
                "movie_id" => $review['movie_id'],
                "created_at" => $review['created_at'],
                "updated_at" => $review['updated_at']
            ];

            array_push($alteredReviews, $alteredReview);
        }
        return view('movie', [
            'movie' => $alteredMovie,
            'reviews' => $alteredReviews,
        ]);
    }

    public function postMovie(Request $req)
    {
        // Needs validator

        $movie = Movie::create([ // How to protect from injections? Look this up
            'title' => $req->title,
            'genre' => $req->genre,
            'cast' => json_encode(array($req->cast)), // Depending on how the user gets to submit the cast, explode by ","?
            'abstract' => $req->abstract,
            'urls_images' => json_encode(array($req->images)), // How does the user get to submit img paths?
            'url_trailer' => $req->trailer, // This should be the movie id on YT, not the entire url
            'avg_rating' => $req->rating, // Should not be manually submitted?
            'released' => (int)$req->released
        ]);

        return view('movie', ['movie' => $movie]);
    }

    // public function deleteMovie($id)
    // {
    //     Movie::destroy($id);
    //     return redirect('dashboard-admin'); // Correct redirect? Since only admins are supposed to be able to delete?
    // }

    // public function editMovie($id)
    // {   
    //     // Needs validator
    //     $movie = Movie::find($id);

    //     $imgsToArray = json_decode($movie->urls_images); 

    //     $alteredMovie = [
    //         'id' => $movie->id,
    //         'title' => $movie->title,
    //         'genre' => $movie->genre,
    //         'cast' => json_decode($movie->cast),
    //         'abstract' => $movie->abstract,
    //         'urls_images' => "https://image.tmdb.org/t/p/w1280$imgsToArray[0]",
    //         'url_trailer' => $movie->url_trailer,
    //         'avg_rating' => $movie->avg_rating,
    //         'released' => $movie->released
    //     ];

    //     return view('edit-movie', ['movie' => $alteredMovie]);
        
    // }

    public function updateMovie(Request $req, $id) 
    {
        $movie = Movie::where('id', $id)->update([
            'title' => $req->title,
            'genre' => $req->genre, 
            'cast' => json_encode(array($req->cast)),
            'abstract' => $req->abstract,
            'url_trailer' => $req->url_trailer,
            'released' => (int)$req->released
        ]);

        return view('movie', ['movie' => $movie]);
    }
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


    public function store(Request $request)
    {
        //dd($request);
        if (Auth::check() && Auth::user()->is_admin) :
            //dd(request());
            $request["is_admin"] = $request["is_admin"] ? 1 : 0; //convert checkbox value to tinyint, 1 or 0
            $attributes = request()->validate([
                'title' => ['required'],
                'genre' => ['required'],
                'released' => ['required'],
                'abstract' => ['required'],
                //'urls_images' => ['required'],
                'url_trailer' => ['required'],
            ]);

            //dd('validation success'); //for debugging, to see if store method is called
            //Movie::create($attributes);
         
            Movie::create([ // How to protect from injections? Look this up
                'title' => $attributes['title'],
                'genre' => $attributes['genre'],
               // 'cast' => json_encode(array($rattributes->cast)), // Depending on how the user gets to submit the cast, explode by ","?
                'abstract' => $attributes['abstract'],
               // 'urls_images' => json_encode(array($attributes->images)), // How does the user get to submit img paths?
                'url_trailer' => $attributes['trailer'], // This should be the movie id on YT, not the entire url
               // 'avg_rating' => $attributes->rating, // Should not be manually submitted?
                'released' => (int)$attributes['released']
            ]);


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

     

    
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        $movie->update($request->all());
        
        //return redirect('admin-main');
        return redirect()->back();
       
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


    //needs to be modified: from https://medium.com/geekculture/how-to-upload-multiple-images-in-laravel-b98c95324594
//     public function addImage(Request $request)
//    {
//       $this->validate($request, [
//          'name' => 'required|string|max:255',
//          'description' => 'required|string|max:855',
//    ]);
//    $movie = new Movie;
//    $movie->name = $request->name;
//    $movie->abstract = $request->abstract;
//    $movie->save();
//    foreach ($request->file('images') as $imagefile) {
//      $image = new Image;
//      $path = $imagefile->store('/images/resource', ['disk' =>   'my_files']);
//      $image->url = $path;
//      $image->movie_id = $movie->id;
//      $image->save();
//    }}

// Simon s search() // cast search needs fix
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
    // admin movie search  
    public function adminSearchMovie(Request $request) // and/ or $name
    {
        
        $query = $request->input('query');
        //dd($query);
        $movie = Movie::where('title', 'like', '%' . $query . '%')
        ->orWhere('abstract', 'like', '%' . $query . '%')->first(); // '%' are regex placeholders, 


        return view('admin.movie-cast', ['movie' => $movie]);
    }


}


