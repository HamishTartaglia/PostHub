@extends('layouts.app')

@section('content')
    <div class="container p-4" id="categories">
        <div class="d-flex justify-content-center" id="category-title">
            <h5>All Categories</h5>
        </div>
        <br>
        @foreach ($categories as $category)
            <div class="d-flex justify-content-center" id="category" onclick="location.href='{{ route('categories.show', ['category' => $category ]) }}'">
                <h6>{{$category->name}}</h6>
            </div><br>
        @endforeach
        <div class="d-flex justify-content-center" id="category" onclick="location.href='{{ route('nasa.show') }}'">
            <h6>Nasa Picture of the Day!</h6>
        </div><br>
    </div>
@endsection
