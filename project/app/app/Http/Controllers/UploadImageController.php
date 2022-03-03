<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class UploadImageController extends Controller
{
    public function index()
    {
        return view('upload_img');
    }

    public function save(Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        
        $name = $request->file('image')->getClientOriginalName();
        $user_id = $request->user_id;
        $path = $request->file('image')->store('public/assets/images');
    


        $save = new Image;

        $save->name = $name;
        $save->path = $path;
        $save->user_id = $user_id;

        $save->save();
    
        return redirect()->back()->with('status', "{$name} has been uploaded");
    }
}
