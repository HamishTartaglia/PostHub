@extends('layouts.app')

@section('title','Categories')

@section('content')

    <p>All Categories</p>
    <ul>
        @foreach ($categories as $category)

            <li> <a href = "{{ route('categories.show', ['category' => $category]) }}"> {{$category->name}}</li>
                
        @endforeach
    </ul>
@endsection
