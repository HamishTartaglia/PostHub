@extends('layouts.app')

@section('title','Create Post')
    
@section('content')

    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('post.store', $category->id)}}" id="create">
            @csrf
            <div>
                <div class="create-title">
                    <h5>Create a post in {{$category->name}}</h5>
                </div><br>
                <h5>Title: </h5>
                <input type="text" name="title" value="{{ old('title') }} " class="form-control">
                <br>
                <h5>Body: </h5>
                <textarea type="text" name="body" value="{{ old('body') }} " class="form-control" id="post-body"></textarea>
            </div>
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
            <input type="submit" value="Submit" class="btn">
            <a href = "{{ route('categories.show', ['category' => $category ])}}">Cancel</a>
        </form>
    </div>
@endsection