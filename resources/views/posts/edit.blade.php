@extends('layouts.app')

@section('title','Edit Post')
    
@section('content')

    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('post.update', ['category' => $category,'post' => $post])}}" id="create">
            @csrf
            @method('PUT')
            <div class="create-title">
                <h5>Edit your post</h5>
            </div><br>
            
            <h5>Title: </h5>
            <input type="text" name="title" value="{{$post->title}}" class="form-control">
            <br>
            <h5>Body: </h5>
            <textarea type="text" name="body" class="form-control" id="post-body">{{$post->body}}</textarea>
    
            {{--
            <p>Category ID: <input type="text" name="category_id"
                value="{{ old('category_id') }} "></p>
                
    
            <select name = "category_id">
                @foreach ($categories as $category)
    
                    <option value="{{ $category->id }}"
                        @if ($category->id == old('category_id'))
                            selected="selected"
                        @endif
                        >
                        {{ $category->name}}
                    </option>
                    
                @endforeach
                --}}
            <br>
            <div class="navbar">
                <a href = "{{ route('posts.show', ['category' => $category,'post' => $post->id ])}}"><button type="button" class="btn">Cancel</button></a>
                <input type="submit" value="Submit" class="btn">
            </div>
        </form>
    </div>
@endsection