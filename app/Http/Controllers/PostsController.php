<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create (){

        return view('posts.create');
    }

    public function store(){
        // $data = request()->validate ([
        //     'caption' => 'required',
        //     'image' => 'reqired | image',
        // ]);

        $data = request()->validate([
            'caption' => 'required',

        ]);

        // auth()->user()->posts()->create($data);

        dd(request()->all());
    }
}
