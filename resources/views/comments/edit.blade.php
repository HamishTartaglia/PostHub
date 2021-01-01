@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('comment.update', ['comment' => $comment])}}" id="edit">
            @csrf
            @method('PUT')
            <div class="edit-title">
                <h5>Edit your comment</h5>
            </div><br>
            
            <h5>Comment: </h5>
            <textarea type="text" name="body" class="form-control">{{$comment->body}}</textarea>
            <br>
            @error('body')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror

            <div class="navbar">
                <a href = "{{ route('posts.show', ['category' => $comment->post->category,'post' => $comment->post ])}}"><button type="button" class="btn">Cancel</button></a>
                <input type="submit" value="Submit" class="btn">
            </div>
        </form>
    </div>

@endsection
