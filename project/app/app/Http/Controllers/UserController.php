<?php

namespace App\Http\Controllers;
use App\Models\User;  

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all unsers
        //$users = User::latest()->firstWhere(request(['name', 'email', 'password','watchlist']))->paginate(2)->withQueryString(); //lookup eager loading
        $users = User::firstWhere(request(['name', 'email', 'password','watchlist']))->paginate(3)->withQueryString(); //
        //$users = User::get(); 
        return view('dashboard', ['users' => $users]);//->paginate(2);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create'); //route needs to be defined
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
        //dd(request());
        $request["is_admin"] = $request["is_admin"] ? 1 : 0; //convert checkbox value to tinyint, 1 or 0
        $attributes = request()->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required', 'min:7', 'max:255'],
            'is_admin' => ['required']
        ]);

        //dd('validation success'); //for debugging, to see if store method is called
        User::create($attributes);
        session()->flash('success', 'User created successfully');
        //return redirect()->back(); //back() redirects to previous page
        return redirect('/dashboard');
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
}
