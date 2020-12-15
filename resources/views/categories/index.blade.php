@extends('layouts.app')

@section('title','Categories')

@section('content')

    <p>All Categories</p>
    <ul>
        @foreach ($categories as $category)

            <li> {{$category->name}}</li>
                
        @endforeach
    </ul>
@endsection
