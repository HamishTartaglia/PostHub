@extends('layouts.app')

@section('title', $category->name)

@section('content')

    <ul>
        @foreach ($posts as $post)

            <li> <a href = "{{ route('posts.show', ['post' => $post->id]) }}"> {{$post->title}} </a> </li>
     
        @endforeach
    </ul>

    {{$posts->links()}}

    <a href = "{{ route('post.create', ['category' => $category])}}">Create Post</a>

@endsection