@extends('layouts.appLayout')

@section('title','Profiles')

@section('content')

    <p>All profiles</p>
    <ul>
        @foreach ($profiles as $profile)

            <li> <a href = "{{ route('profiles.show', ['profile' => $profile]) }}"> {{$profile->username}}</li>
                
        @endforeach
    </ul>
@endsection
