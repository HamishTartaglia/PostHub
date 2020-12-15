@extends('layouts.app')

@section('title','Profiles')

@section('content')

    <p>All profiles</p>
    <ul>
        @foreach ($profiles as $profile)

            <li> <a href = "{{ route('profiles.show', ['profile' => $profile->id]) }}"> {{$profile->username}}</li>
                
        @endforeach
    </ul>
@endsection
