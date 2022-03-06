<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class UploadImageController extends Controller
{
    public function index()
    {
        return view('img_modal');
    }

    public function save(Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        
        $name = $request->file('image')->getClientOriginalName();
        $user_id = $request->user_id;
        $path = $request->file('image')->store('public/assets/images');
        $image = Image::where('user_id', $request->user_id);

        if($image->exists()) {
            $image->update([
                'name' => $name,
                'path' => $path,
                'user_id' => $user_id
            ]);
        } else {
            $save = new Image;

            $save->name = $name;
            $save->path = $path;
            $save->user_id = $user_id;

            $save->save();
        }

        
    
        return redirect('user/user-settings')->with('success', "{$name} has been uploaded");
    }

    public function delete($id) 
    {

        $image = Image::where('user_id', $id);
        $image->delete();

        session()->flash('success', 'Avatar deleted');

        return redirect()->back();
    }
}