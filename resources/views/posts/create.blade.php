@extends('layouts.appLayout')

@section('title','Create Post')
    
@section('content')
    <form method="POST" action="{{ route('post.store', $category->id)}}">
        @csrf
        <p>Title: <input type="text" name="title"
            value="{{ old('title') }} "></p>

        <p>Body: <input type="text" name="body"
            value="{{ old('body') }} "></p>

        <p>Profile ID: <input type="text" name="profile_id"
            value="{{ old('profile_id') }} "></p>

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