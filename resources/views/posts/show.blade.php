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

    @can('update', $post)
        <button><a href="{{ route('post.edit', ['category' => $post->category,'post' => $post]) }}"> Edit Post </a></button>
    @endcan 

    @can('delete', $post)
        <form action="{{ route('post.destroy', ['post' => $post]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Post</button>
        </form>
    @endcan
        
    

    <form method="POST" action="{{ route('comment.store', $post) }}">
        @csrf
        <input type="text" name="body"
            value = "{{ old('body') }}" 
            placeholder="Comment">
        <input type="submit" value="Submit">
    </form>

    <p>Comments: </p>
    <ul>
        @foreach ($post->comments as $comment)
            
            <li> {{ $comment->body }}
                <p> Posted: {{ $comment->created_at->diffForHumans() }} </p>

                @can('update', $post)
                    <button><a href="{{ route('comment.edit', ['comment' => $comment]) }}"> Edit</a></button>
                @endcan

                @can('delete', $post)
                    <form action="{{ route('comment.destroy', ['comment' => $comment])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endcan
            </li>

        @endforeach

@endsection