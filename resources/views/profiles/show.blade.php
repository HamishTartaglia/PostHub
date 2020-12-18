@extends('layouts.app')

@section('title', $profile->username)

@section('content')

    <p>Description: {{$profile->description}}</p>
    <p>Score: {{$profile->score}}</p>
    <p>Posts:</p>

    <ul>
        @foreach ($profile->posts as $post)

            <li> <a href = "{{ route('posts.show', ['post' => $post->id]) }}"> {{$post->title}} </a> </li>
         
        @endforeach

    </ul>

    <p>Posted in:<p>
    
    <ul>
        @foreach ($profile->posts as $post)

            <li><a href = "{{ route('categories.show', ['category' => $post->category]) }}"> {{$post->category->name}} </a> </li>
            
        @endforeach

    </ul>

@endsection