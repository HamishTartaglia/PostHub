@extends('layouts.app')

@section('title','Posts')

@section('content')

    <div class="container">
        <p>All posts</p>
            <ul>
                @foreach ($posts as $post)
                    <li> <a href = "{{ route('posts.show', ['category' => $post->category,'post' => $post->id ]) }}">{{$post->title}}</li>
                @endforeach
            </ul>
            {{$posts->links()}}
    </div>
    

@endsection
