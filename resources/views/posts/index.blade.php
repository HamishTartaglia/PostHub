@extends('layouts.app')

@section('content')

    <div class="container p-4">
        <div class="border-right shadow p-3 ms-4 bg-white" id="page-content-wrapper">
            <div class="d-flex justify-content-center" id="posts-title">
                    <h5>All Posts</h5>
                </div>
                <br>
                <ul>
                    @foreach ($posts as $post)
                        <div class="post" onclick="location.href='{{ route('posts.show', ['category' => $post->category,'post' => $post->id ]) }}'">

                            <li class="list-unstyled"> 
                                <div class="row">
                                    <div class="col">
                                        <h6> {{$post->title}} </h6>
                                        <p class="text-muted">{{ Illuminate\Support\Str::limit($post->body, $limit = 100, $end = '...') }}</p>
                                    </div>
                                    <div class="col" id="img-preview">
                                        @if (isset($post->photo)) 
                                            @php
                                                $filename = $post->photo->filename;
                                                $filename = ltrim($filename, 'public');
                                            @endphp 
                                            <img src ="{{ asset($filename)}}" id="small-img">
                                        @endif
                                    </div>
                                    
                                    
                                    
                                </div>
                                

                                <div class="row">
                                    <div class="col">
                                        <p class="postedBy">Posted by:
                                            <a href = "{{ route('profiles.show', ['profile' => $post->profile->username]) }}" class="user"> {{$post->profile->username}} </a>
                                        </p>
                                    </div>
                                    <div class="col" id="post-info-score">
                                        <p class="posted">In: <a href = "{{ route('categories.show', ['category' => $post->category->name]) }}" class="user">{{ $post->category->name }}</a></p>
                                    </div>
                                    <div class="col" id="post-info-score">
                                        <p class="posted">Score: {{ $post->score }}</p>
                                    </div>
                                    <div class="col" id="post-info-time">
                                        <p class="posted"> Posted: {{ $post->created_at->diffForHumans() }} </p>
                                    </div>
                                </div>
                            </li>

                
                        </div><br>
                    @endforeach
                </ul>
                <div class="d-flex justify-content-center">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
        

@endsection
