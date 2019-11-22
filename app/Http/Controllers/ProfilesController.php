<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    //show a user's profile
    public function index($user)
    {
        $user = User::findOrFail($user);

        //return view('welcome');
        return view('profiles.index', [ 'user' => $user, ]);
    }

    //redirect to the edit profile form
    public function edit(User $user){

        //allows the "update" function in the policy for the user
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    //update the user's profile
    public function update(User $user){

        //allows the "update" function in the policy for the user
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'image' => '',
        ]);

        //check to see if the user is updating their profile image
        if(request('image')){
            //upload the file to storage/app/public/uploads
            $path = request('image')->store('profile','public');

            //make the images 1000*1000
            $image = Image::make(public_path("storage/{$path}"))->fit(1000, 1000);

            $image->save();
        }


        //array_merge will merge the $data and override it's image key with the $path variable
        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $path]
        ));

        return redirect("/profile/{$user->id}");
    }
}
