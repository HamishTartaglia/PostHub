@extends('layouts.appLayout')

@section('title','Comments')

@section('content')

    <p>All comments</p>
    <ul>
        @foreach ($comments as $comment)

            <li> <a href = "{{ route('posts.show', ['category' => $comment->post->category ,'post' => $comment->post]) }}">{{$comment->body}} </a> </li>
                
        @endforeach
    </ul>

@endsection
