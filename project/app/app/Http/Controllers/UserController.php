<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Image;



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;



class UserController extends Controller
{

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->is_admin) :
            $request["is_admin"] = $request["is_admin"] ? 1 : 0;
            $attributes = request()->validate([
                'name' => ['required', 'string', 'min:5', 'max:255'],
                'email' => ['required', 'max:255', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:7', 'max:255'],
                'is_admin' => ['required']
            ]);

            User::create([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'password' => bcrypt($attributes['password']),
                'is_admin' => $attributes['is_admin']
            ]);

            session()->flash('success', 'User created successfully');
        endif;
        return redirect()->back();
    }


    public function edit($id)
    {
        $user = User::find($id);
        $allMovies = Movie::pluck('id', 'title')->all();
        return view('admin.edit-user', ['user' => $user, 'allMovies' => $allMovies]);
    }


    public function search(Request $request)
    {

        $query = $request->input('query');
        $user = User::where('email', 'like', '%' . $query . '%')->orWhere('name', 'like', '%' . $query . '%')->first();
        return view('admin.edit-user', ['user' => $user]);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request["is_admin"] = $request["is_admin"] ? 1 : 0;
        $user->update($request->all());

        return redirect('admin-main')->with('status', 'User data updated.');
    }


    public function updateSettings(Request $request)
    {
        //
        $userID = Auth::user('id');
        $user = User::find($userID)->first();

        // $validation = Validator::make($request->all(), [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
        // ]);

        // if ($validation->fails()) {
        //     $errors = response()->json([
        //         'status' => 'failure',
        //         'errors' => $validation->errors()
        //     ], 400);

        //     session()->flash('status', $errors);

        //     return redirect('user/user-settings');
        // }

        // $user::update([
        //     'name' => $updates['name'],
        //     'email' => $updates['email'],
        //     'password' => Hash::make($updates['password'])
        // ]);


        // ------------WORKS BUT IS PROBABLY BAD PRACTICE
        $user->name = $request->get('name');
        $user->email = $request->get('email');


        if (($request->get('password')) === ($request->get('passConfirm'))) {
            $user->password = password_hash($request->get('password'), PASSWORD_BCRYPT);
        }
        $user->save();

        session()->flash('success', 'updated successfully!');

        return redirect('user/user-settings');
    }

    public function destroy($id)
    {

        User::destroy($id);
        session()->flash('success', 'User deleted');
        return redirect()->back();
    }

    public function settings()
    {
        $user = User::get();
        $image = Image::where('user_id', Auth::user()->id)->first();

        return view('user-settings', ['image' => $image]);
    }

    public function updateWatchlist($movieId)
    {
        $user = User::find(Auth::user()->id);

        $watchlist = [];

        if ($user->watchlist != null) {
            $watchlist = json_decode($user->watchlist);
        }

        array_push($watchlist, $movieId);

        $user->watchlist = json_encode($watchlist);
        $user->update();
        return redirect()->back()->with('status', 'Movie added to watchlist');
    }

    public function removeFromWatchlist($movieId)
    {
        $user = User::find(Auth::user()->id);

        $watchlist = [];
        foreach (json_decode($user->watchlist) as $value) {
            if ($value != $movieId) {
                array_push($watchlist, $value);
            }
        }

        $user->watchlist = json_encode($watchlist);
        $user->update();
        return redirect()->back()->with('status', 'Movie removed from watchlist');
    }

    public function showWatchlist()
    {

        $user = User::find(Auth::user()->id);

        $image = Image::where('user_id', $user->id)->first();

        $watchlistMovies = [];
        if ($user->watchlist) {
            foreach (json_decode($user->watchlist) as $id) {
                $movie = Movie::where('id', $id)->first();
                $imgsToArray = json_decode($movie->urls_images);

                $watchlistMovie = [
                    'id' => $movie->id,
                    'title' => $movie->title,
                    'genre' => $movie->genre,
                    'cast' => json_decode($movie->cast),
                    'abstract' => $movie->abstract,
                    'urls_images' => $imgsToArray[0],
                    'avg_rating' => $movie->avg_rating,
                    'released' => $movie->released
                ];
                array_push($watchlistMovies, $watchlistMovie);
            }
        }

        return view('/userpage', ['watchlist' => $watchlistMovies, 'image' => $image]);
    }
}
