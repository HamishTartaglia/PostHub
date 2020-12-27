@extends('layouts.app')

@section('title','Profiles')

@section('content')

    <div class="container p-4" id="profiles">
        <div class="d-flex justify-content-center" id="profiles-title">
            <h5>All profiles</h5>
        </div>
        <br>
        @foreach ($profiles as $profile)
            <div class="d-flex justify-content-center" id="profile" onclick="location.href='{{ route('profiles.show', ['profile' => $profile]) }}'">
                <h6>{{$profile->username}}</h6>
            </div><br>
        @endforeach
    </div>

@endsection
