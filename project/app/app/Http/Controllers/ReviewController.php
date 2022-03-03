<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

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
    public function create()
    {
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
        // $validatedData = $request->validate([
        //     'content' => 'required|max:1000',
        //     'rating' => 'required',
        //     'user_id' => 'required',
        //     'movie_id' => 'required'
        //         ]);
        //  Review::create($validatedData);
        //dd($request);
        if($request->movie_rating === null){
            return redirect()->back()->with('status', "You have to fill in a rating for this movie!");
                }
        else{
            
            $review = new Review;
            $review->title = $request->title;
            $review->review_content = $request->content;
            $review->review_rating = $request->movie_rating;
            $review->user_id = $request->user_id;
            $review->movie_id = $request->movie_id;

            $review->save();
            return redirect()->back()->with('status', 'Creating review was successful!');
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

     // OLD
    // public function edit($id)
    // {
    //     //Get the review from database
    //     $review = Review::find($id);

    //     //show the form and get data from form
    //     return view('reviews/edit')
    //     ->with('review', $review);
    // }

    public function edit($id)
    {
        $review = Review::find($id);  
        return view('admin.edit-review', ['review' => $review]);

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
        $review = Review::find($id);
        $review->review_content = $request->input('title');
        $review->review_content = $request->input('content');
        $review->review_rating = $request->input('rating');
        $review->movie_id = $request->input('movie_id');
        $review->update();
        return redirect()->back()->with('status','Review Updated Successfully');
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
