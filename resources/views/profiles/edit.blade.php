@extends('layouts.app')

@section('title','Edit Profile')
    
@section('content')

    <form method="POST" action="{{ route('profile.update', ['profile' => $profile])}}">
        @csrf
        @method('PUT')
        <p>Description: <input type="text" name="description"
            value="{{$profile->description}}"> </p>

        <input type="submit" value="Submit">
        <a href = "{{ route('profiles.show', ['profile' => $profile])}}">Cancel</a>
    </form>
    
@endsection