@extends('layouts.app')

@section('title', $category->name)

@section('content')

    <div class="container">
        <ul>
                @foreach ($posts as $post)
                    <div class="post" onclick="location.href='{{ route('posts.show', ['category' => $post->category,'post' => $post->id ]) }}'">

                        <li class="list-unstyled"> 
                            <h6>{{$post->title}}</h2>
                            <p class="text-muted">{{ Illuminate\Support\Str::limit($post->body, $limit = 100, $end = '...') }}</p>
                            <div class="navbar">
                                <footer class="blockquote-footer">Posted by:
                                    <a href = "{{ route('profiles.show', ['profile' => $post->profile->username]) }}"> {{$post->profile->username}} </a></footer>
                                <p class="posted"> Posted: {{ $post->created_at->diffForHumans() }} </p>
                            </div>
                        </li>

            
                    </div><br>
                @endforeach
            </ul>

            <div class="d-flex justify-content-center">
                {{$posts->links()}}
            </div>


            <a href = "{{ route('post.create', ['category' => $category])}}">Create Post</a>
    </div>
    

@endsection