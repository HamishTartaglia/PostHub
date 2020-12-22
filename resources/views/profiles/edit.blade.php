@extends('layouts.app')

@section('title','Edit Profile')
    
@section('content')

    <form method="POST" action="{{ route('profile.update', ['profile' => $profile])}}">
        @csrf
        @method('PUT')
        <p>Bio: <input type="text" name="bio"
            value="{{$profile->bio}}"> </p>

        <input type="submit" value="Submit">
        <a href = "{{ route('profiles.show', ['profile' => $profile])}}">Cancel</a>
    </form>
    
@endsection