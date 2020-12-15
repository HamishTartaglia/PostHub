@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <ul>
        <li>{{$post->body}}</li>
        <li>Score: {{$post->score}}</li>
        <li>By: {{$post->profile->username}}</li>
        <li>From: {{$post->category->name}}</li>

    </ul>


@endsection