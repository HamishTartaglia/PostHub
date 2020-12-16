@extends('layouts.app')

@section('title','Posts')

@section('content')

    <p>All posts</p>
    <ul>
        @foreach ($posts as $post)
            <li> <a href = "{{ route('posts.show', ['post' => $post->id]) }}">{{$post->title}}</li>
        @endforeach
    </ul>
{{$posts->links()}}

@endsection
