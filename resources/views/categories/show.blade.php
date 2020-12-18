@extends('layouts.app')

@section('title', $category->name)

@section('content')

    <ul>
        @foreach ($posts as $post)
            <div>

                <li> 
                    <a href = "{{ route('posts.show', ['post' => $post->id]) }}"> {{$post->title}} </a> <br>
                    <a> {{$post->body}} </a><br>
                    <a href = "{{ route('profiles.show', ['profile' => $post->profile->username]) }}"> {{$post->profile->username}} </a>
                </li>

     
            </div><br>
        @endforeach
    </ul>

    {{$posts->links()}}

    <a href = "{{ route('post.create', ['category' => $category])}}">Create Post</a>

@endsection