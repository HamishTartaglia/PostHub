@extends('layouts.app')

@section('title','Comments')

@section('content')

    <p>All comments</p>
    <ul>
        @foreach ($comments as $comment)

            <li> <a href = "{{ route('posts.show', ['post' => $comment->post]) }}">{{$comment->body}}</li>
                
        @endforeach
    </ul>

@endsection
