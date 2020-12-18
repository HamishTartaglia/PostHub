@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <ul>
        <li>{{$post->body}}</li>
        <li>Score: {{$post->score}}</li>
        <li>By: <a href = "{{ route('profiles.show', ['profile' => $post->profile->id]) }}"> {{$post->profile->username}} </a> </li>
        <li>From: <a href = "{{ route('categories.show', ['category' => $post->category->id]) }}"> {{$post->category->name}} </a> </li>
        <li>Tags:
            <ul>
                @foreach ($post->tags as $tag)

                    <li>{{$tag->name}} </a> </li>
     
                @endforeach
            </ul>
            
    </ul>

    <p>Comments: </p>
    <ul>
        @foreach ($post->comments as $comment)
            
            <li> {{ $comment->body }}

        @endforeach

@endsection