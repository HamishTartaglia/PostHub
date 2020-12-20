@extends('layouts.app')

@section('title','Edit Post')
    
@section('content')

    <form method="POST" action="{{ route('post.update', ['category' => $category,'post' => $post])}}">
        @csrf
        @method('PUT')
        <p>Title: <input type="text" name="title"
            value="{{$post->title}}"> </p>

        <p>Body: <input type="text" name="body"
            value="{{$post->body}}"></p>

        <p>Profile ID: <input type="text" name="profile_id"
            value="{{$post->profile_id}}"> </p>

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

        <input type="submit" value="Submit">
        <a href = "{{ route('posts.index')}}">Cancel</a>
    </form>
    
@endsection