<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    //So all the routes underneath will require an authorization
    public function __construct(){

        $this->middleware('auth');
    }

    public function create (){

        return view('posts.create');
    }

    //save a post in the DB
    public function store(Request $request){

        $data = request()->validate([
            'caption' => 'required',
            'image' => '',
        ]);

        //upload the file to storage/app/public/uploads
        $path = $request->file('image')->store('uploads','public');

        //make the images 1200*1200
        $image = Image::make(public_path("storage/{$path}"))->fit(1200, 1200);

        $image->save();

        //Store the post in the DB
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $path,
        ]);

        //redirect back to the user's profile
        return redirect ('/profile/' . auth()->user()->id);
    }

    //redirect to the responsible view in the posts folder
    public function show(\App\Post $post){
        //go to the posts/show
        return view('posts.show', compact('post'));
    }
}
