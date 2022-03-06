<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //function for showing reviews is in index funtion in MovieController
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserRatings($id)
    {

        $reviews = Review::where('user_id', $id)->get();
        $allMovies = Movie::pluck('id', 'title')->all();


        return view('reviews/userratings', compact('reviews', 'allMovies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->review_rating === null) {
            return redirect()->back()->with('status', "You have to fill in a rating for this movie!");
        } else {
            
            $validatedData = $request->validate([
                'review_content' => 'nullable|max:1000',
                'title' => 'nullable',
                'review_rating' => 'required',
                'user_id' => 'required',
                'movie_id' => 'required'
                    ]);
             Review::create($validatedData);

            $reviews = Review::where('movie_id', $request->movie_id)->get()->toArray();

            if ($reviews) {
                $ratings = [$request->review_rating];

                foreach ($reviews as $review) {
                    array_push($ratings, $review['review_rating']);
                }

                $movie = Movie::find($request->movie_id);
                $movie->avg_rating = array_sum($ratings)/count($ratings);
                $movie->update();
            }

                return redirect()->back()->with('status', 'Creating review was successful! It will show up on the page once an admin has approved it.');
        }
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
        $review = review::find($id);
        return view('reviews/show')-> with('review', $review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // for approval by admin
    public function editApprove($id)
    {
        if (Auth::check() && Auth::user()->is_admin){
        $review = Review::find($id);  
        return view('admin.edit-review', ['review' => $review]);
        }
    }

    // for registered user
    public function edit($id)
    {
        //Get the id of the movie for showing title of movie
        $movieId = Review::where('id', $id)->value('movie_id');
        $movie = Movie::find($movieId);

        //Get the review from database
        $review = Review::find($id);

        
        //show the form and get data from form
        return view('reviews/edit', [
            'review' => $review,
             'movie' => $movie
        ]);

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
        if ($request->movie_rating === null) {
            return redirect()->back()->with('status', "You have to fill in a rating for this movie!");
        } else {
        $review = Review::find($id);
        $review->review_content = $request->input('title');
        $review->review_content = $request->input('content');
        $review->review_rating = $request->input('movie_rating');
        $review->movie_id = $request->input('movie_id');
        $review->update();
        return redirect()->back()->with('status','Review Updated Successfully');
    }}

    // combine with above? 
    public function updateApprove(Request $request, $id)
    {
        $review = Review::find($id);
        $request["is_approved"] = $request["is_approved"] ? 1 : 0; 
        $review->update($request->all());
        
        return redirect('admin-main')->with('status','Review data updated.');
        //return redirect()->back(); // results in error if called from update page
       
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();
        session()->flash('success', 'Review deleted.');
        return redirect()->back(); //->with('status','Review deleted.');

        
    }
}
