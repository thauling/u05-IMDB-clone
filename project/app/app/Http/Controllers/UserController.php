<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function register(Request $request)
    {
       // dd('at least I have made it this far');
        $attributes = request()->validate([
            'name' => 'required', //['required', 'string', 'min:5', 'max:255'],
            'email' => 'required', //['required', 'max:255', 'email', 'unique:users,email'],
            'password' => 'required'// ['required', 'string', 'confirmed', 'min:7', 'max:255'] // 'confirmed' for user regis
            //'is_admin' => ['required']
        ]);

        //dd('validation success'); //for debugging, to see if store method is called
        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password'])
            // is_admin is set to false by default 
        ]);

        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        session()->flash('success', 'User registered', response($response, 201));
        return response($response, 201);
        //return redirect('home');
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();
        session()->flash('success', 'User logged out');
        return ['message' => 'User logged out'];
        //return redirect('home');
    }

    //login with email and password
    public function login(Request $request) {

        $attributes = request()->validate([
            //'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required','string'] // 'confirmed' for user regis
        ]);

        // get (first) user with matching email, will be null if user does not exist
        $user = User::where('email', $attributes['email'])->first();
        // return error if user does NOT exist or psw does NOT match
        if (!$user || !Hash::check($attributes['password'], $user->password)) {
            return response(['message' => 'user does not exist or password is incorrect'], 401);
        }
        // else assign token
        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        session()->flash('success', 'User logged in',  response($response, 201));
       // return response($response, 201); //if api, if called from wep.php use:
       return redirect('home'); //or whatever landig page is called, nneds to be defined
    }


    public function index()
    {
        //show all unsers
        //$users = User::latest()->firstWhere(request(['name', 'email', 'password','watchlist']))->paginate(2)->withQueryString(); //lookup eager loading
        //$users = User::firstWhere(request(['name', 'email', 'password','watchlist']))->paginate(3)->withQueryString(); //
        // $users = User::paginate(5); 
        // $users = User::get();
        $users = User::all();  // same as 'get()' ?
        return view('dashboard-admin', ['users' => $users]); //->paginate(2);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    //     // need to implement authorization logic here
    //     if (auth()->user()->is_admin === false) {   //pseudocode! require middleware 'auth'
    //         abort(Response::HTTP_FORBIDDEN);
    //     }



    //     return view('users.create'); //route needs to be defined
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd(request());
        $request["is_admin"] = $request["is_admin"] ? 1 : 0; //convert checkbox value to tinyint, 1 or 0
        $attributes = request()->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:7', 'max:255'], // 'confirmed' for user regis
            'is_admin' => ['required']
        ]);

        //dd('validation success'); //for debugging, to see if store method is called
        //User::create($attributes);
        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password']),
            'is_admin' => $attributes['is_admin'] 
        ]);

        session()->flash('success', 'User created successfully');
        //return redirect()->back(); //back() redirects to previous page
        return redirect('dashboard-admin'); //return redirect()->to('dashboard');
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
        $user = User::find($id);  // same as 'get()' ?
        return view('dashboard-admin', ['user' => $user]); //->paginate(2);      
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
        $user = User::find($id);
        $user->update($request->all());
        return $user;
        // should nt this be $user->save(); ?
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSettings(Request $request)
    {
        //
        $userID = Auth::user('id');
        $user = User::find($userID)->first();

        // ---------------DOESNT WORK
        // $updates = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        // $user::update([
        //     'name' => $updates['name'],
        //     'email' => $updates['email'],
        //     'password' => Hash::make($updates['password'])
        // ]);


        // ------------WORKS BUT IS PROBABLY BAD PRACTICE
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        
        if(($request->get('password')) === ($request->get('passConfirm'))){
            $user->password = password_hash($request->get('password'), PASSWORD_BCRYPT); 
        }
        $user->save();

        session()->flash('status', 'updated successfully!');

        return redirect('user/user-settings');
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
        User::destroy($id);
        session()->flash('success', 'User deleted');
        //return redirect()->back(); //back() redirects to previous page
        return redirect('dashboard-admin'); 
    }

    public function search($email) // and/ or $name
    {
        //
        return User::where('email', 'like', '%' . $email . '%')->get(); // '%' are regex placeholders, 
        // for exact search, do
        //return User::where('email', $email)->get();

    }

    public function settings()
    {
        $user = User::get();

        return view('user-settings', ['user' => $user]);
    }
}
