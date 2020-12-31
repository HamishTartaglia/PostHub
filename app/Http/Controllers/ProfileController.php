<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::simplePaginate(10);
        return(view('profiles.index',['profiles' => $profiles]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('profiles.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('profiles.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $validatedData = $request->validate([
            'bio' => 'required|max:50',
            'image' => ''
        ]);

        $profile->bio = $validatedData['bio'];
        $profile->save();

        if ($request->hasFile('image')) {
            $validatedData['image']->store('images','public');

            if($profile->photo == null){
                $photo = new Photo;
                $photo->filename = "public/images/".$validatedData['image']->hashName();
                $photo->photoable_type = Profile::class;
                $photo->photoable_id = $profile->id;
                $photo->save();
            }else{
                $photo = $profile->photo;
            $photo->filename = "public/images/".$validatedData['image']->hashName();
            $photo->photoable_type = Profile::class;
            $photo->save();
            }            
        }

        return redirect()->route('profiles.show', ['profile' => $profile])->with('message','Profile Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $id = $profile->id;
        $user = User::find($id);
        $user->delete();
        $profile->delete();

        return redirect()->route('home')->with('message','Post Deleted!');
    }

    /**
     * Logs the current user out
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home')->with('message','Logged Out!');
    }
}
