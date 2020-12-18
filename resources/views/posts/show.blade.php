@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <ul>
        <li>{{$post->body}}</li>
        <li>Score: {{$post->score}}</li>
        <li>By: <a href = "{{ route('profiles.show', ['profile' => $post->profile]) }}"> {{$post->profile->username}} </a> </li>
        <li>From: <a href = "{{ route('categories.show', ['category' => $post->category]) }}"> {{$post->category->name}} </a> </li>
        <li>Tags:
            <ul>
                @foreach ($post->tags as $tag)

                    <li>{{$tag->name}} </a> </li>
     
                @endforeach
            </ul>
    </ul>

    <form method="POST" action="{{ route('comment.store', $post) }}">
        @csrf
        <p>Body: <input type="text" name="body"
            value = "{{ old('body') }}"> </p>
        <p>Profile ID: <input type="text" name="profile_id"
            value = "{{ old('profile_id') }}"> </p>        
        <input type="submit" value="Submit">
    </form>

    <p>Comments: </p>
    <ul>
        @foreach ($post->comments as $comment)
            
            <li> {{ $comment->body }}

        @endforeach

@endsection