@extends('layouts.app')

@section('content')

    <div class="container p-4">
        <div>
            <div class="d-flex justify-content-center" id="posts-title">
                <h5>{{$category->name}}</h5>
            </div>
            <br>

            @if (Auth::check())
                <div class="d-flex justify-content-end">
                    <a href = "{{ route('post.create', ['category' => $category])}}"><button type="button" class="btn">Create Post</button></a>
                </div>
            @endif
        </div>
        <br>
        
        <ul>
            @foreach ($posts as $post)
                <div class="post" onclick="location.href='{{ route('posts.show', ['category' => $post->category,'post' => $post->id ]) }}'">

                    <li class="list-unstyled"> 
                        <h6> {{$post->title}} </h6>
                        <p class="text-muted">{{ Illuminate\Support\Str::limit($post->body, $limit = 100, $end = '...') }}</p>
                        <div class="navbar">
                            <p class="postedBy">Posted by:
                                <a href = "{{ route('profiles.show', ['profile' => $post->profile->username]) }}" class="user"> {{$post->profile->username}} </a></p>
                            <p class="posted"> Posted: {{ $post->created_at->diffForHumans() }} </p>
                        </div>
                    </li>

        
                </div><br>
            @endforeach
        </ul>

        <div class="d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>

@endsection