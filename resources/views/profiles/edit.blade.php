@extends('layouts.app')

@section('title','Edit Profile')
    
@section('content')


    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('profile.update', ['profile' => $profile])}}" id="edit">
            @csrf
            @method('PUT')
            <div class="edit-title">
                <h5>Edit your profile - {{$profile->username}}</h5>
            </div><br>
            
            <h5>Bio: </h5>
            <input type="text" name="bio" value="{{$profile->bio}}" class="form-control">
            <br>
            <div class="navbar">
                <a href = "{{ route('profiles.show', ['profile' => $profile])}}"><button type="button" class="btn">Cancel</button></a>
                <input type="submit" value="Submit" class="btn">
            </div>
        </form>
    </div>

    
@endsection