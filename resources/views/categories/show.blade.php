@extends('layouts.app')

@section('title', $category->name)

@section('content')

    <ul>
        @foreach ($category->posts as $post)

            <li> <a href = "{{ route('posts.show', ['post' => $post->id]) }}"> {{$post->title}} </a> </li>
     
        @endforeach
    </ul>

    <a href = "{{ route('post.create', ['category' => $category])}}">Create Post</a>

@endsection