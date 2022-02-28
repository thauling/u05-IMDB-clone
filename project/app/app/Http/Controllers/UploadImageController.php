<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class UploadImageController extends Controller
{
    public function index()
    {
        return view('admin.movie-images'); // 'should be route that displays image'
    }

    public function save(Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        //dd('validated');
        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->store('public/assets/images'); //make sure this folder exists


        $save = new Image;

        $save->name = $name;
        $save->path = $path;

        $save->save();
    // dd('validated');
        return redirect()->back()->with('status', "{$name} has been uploaded");
    }
}
