@extends('layouts.app')

@section('content')

    <div class="container p-4">
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
        </div>
    </div>

@endsection