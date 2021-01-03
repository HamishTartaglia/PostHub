@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('post.update', ['category' => $category,'post' => $post])}}" id="edit">
            @csrf
            @method('PUT')
            <div class="edit-title">
                <h5>Edit your post</h5>
            </div><br>
            
            <h5>Title: </h5>
            <input type="text" name="title" value="{{$post->title}}" class="form-control">
            <br>
            @error('title')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror


            <h5>Body: </h5>
            <textarea type="text" name="body" class="form-control" id="post-body">{{$post->body}}</textarea>
            <br>
            @error('body')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
            
            <div class="navbar">
                <a href = "{{ route('posts.show', ['category' => $category,'post' => $post->id ])}}"><button type="button" class="btn">Cancel</button></a>
                <input type="submit" value="Submit" class="btn">
            </div>
        </form>
    </div>
@endsection