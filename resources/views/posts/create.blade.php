@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('post.store', $category->id)}}" id="create" enctype="multipart/form-data">
            @csrf
            <div>
                @php
                    $categories = App\Category::get();
                @endphp
                <div class="create-title">
                    <h5>Create a post in
                        <select onchange="window.location.href=this.value;" id="category-select">
                            @foreach ($categories as $category1)
                                <option value="{{ route('post.create',['category' => $category1->name]) }}" {{$category->name == $category1->name ? 'selected' : '' }}>{{$category1->name}}</option>
                            @endforeach
                        </select>
                    </h5>
                </div><br>
                <h5>Title: </h5>
                <input type="text" name="title" value="{{ old('title') }} " class="form-control" @error('title') is-invalid @enderror>
                <br>
                @error('title')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror

                <h5>Body: </h5>
                <textarea type="text" name="body" class="form-control" id="post-body" @error('body') is-invalid @enderror>{{ old('body') }}</textarea>
                <br>
                @error('body')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                

                <h5>Image:</h5>
                <input id="image" type="file" class="form-control" name="image">
                <br>
                @error('image')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror

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

            <div class="row">
                <h5>Tags:</h5>
                @php
                    $tags = App\Tag::get();
                @endphp
                
                @foreach ($tags as $tag)
                    <div class="col p-3">
                        <p><input class="form-check-input" type="checkbox" name="tags[]" value={{$tag->id}}>
                        {{$tag->name}}</p>
                    </div>
                @endforeach
            </div>

            <div class="navbar">
                <a href = "{{ route('categories.show', ['category' => $category ])}}"><button type="button" class="btn">Cancel</button></a>
                <input type="submit" value="Submit" class="btn">
            </div>
            
        </form>
    </div>
@endsection