@extends('layouts.app')

@section('content')

    <div class="container px-4">
        <div class="row"id="posts-title">
            <div class="col" id="post-title-col">
                <h5><u>NASA Astronomy Picture of the Day:</u></h5> 
                <h5>{{$title}}</h5>
            </div>          
        </div>

        <br>

        <div class="d-flex justify-content-center" id="post-body-text">
            <h6>{{$description}}</h6>       
        </div>
        <div class="d-flex justify-content-center" id="post-pic">
            <img src={{$photo}}>
        </div>


        <div class="row" id="post-info">
            <div class="col">
                <p class="postedBy">Taken by:
                    {{$author}} 
                </p>
            </div>
            <div class="col">
            </div>
            <div class="col">
                <p class="posted">Posted: {{ $date }} </p>
            </div>
        </div>


@endsection