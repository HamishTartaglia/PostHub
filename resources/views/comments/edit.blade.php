@extends('layouts.appLayout')

@section('title','Edit Comment')

@section('content')

        <form method="POST" action="{{ route('comment.update', ['comment' => $comment])}}">
        @csrf
        @method('PUT')
        <p>Body: <input type="text" name="body"
            value="{{$comment->body}}"> </p>

        <p>Profile ID: <input type="text" name="profile_id"
            value="{{$comment->profile_id}}"> </p>

        <input type="submit" value="Submit">
        <a href = "{{ route('posts.show', ['category' => $comment->post->category,'post' => $comment->post ])}}">Cancel</a>
    </form>

@endsection
