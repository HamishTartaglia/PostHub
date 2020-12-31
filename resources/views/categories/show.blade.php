@extends('layouts.app')

@section('content')

    <div class="container px-4">
        <div class="d-flex" id="wrapper">

        
            <div class="border-right shadow p-3 mb-5 bg-white" id="admin-sidebar">

                <h5>Sort:</h5>
                <ul>
                    <li class="list-unstyled">
                        <a href = "{{ route('categories.show.top',['category' => $category])}}"><button class="btn">Top</button></a>
                    </li>
                    <br>
                    <li class="list-unstyled">
                        <a href = "{{ route('categories.show.newest',['category' => $category])}}"><button class="btn">Newest</button></a>
                    </li>
                    <br>
                    <li class="list-unstyled">
                        <a href = "{{ route('categories.show.oldest',['category' => $category])}}"><button class="btn">Oldest</button></a>
                    </li>
                    <br>
                </ul>
                
                <h5> Admins: </h5>
                <ul>
                    @foreach ($category->admins as $admin)
                        <p> <a href="{{route('profiles.show',['profile' => $admin->profile])}}" class="category-link"> {{$admin->profile->username}} </a></p>
                    @endforeach
                </ul>   


            </div>


            <div id="page-content-wrapper">
                <div class="row" id="posts-title">
                    <div class="col" id="category-name">
                        <h5 >{{$category->name}}</h5>
                    </div>
                    <div class="col">
                        @if (Auth::check())
                            <div class="d-flex justify-content-end">
                                <a href = "{{ route('post.create', ['category' => $category])}}"><button type="button" class="btn" id="create-btn">Create Post</button></a>
                            </div>
                        @endif
                    </div>
                    
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
    </div>

@endsection