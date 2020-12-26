@extends('layouts.app')

@section('title', $profile->username)

@section('content')

    <div class="container">

        <div class="d-flex" id="wrapper">

            <div class="border-right" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                    <div class="navbar">
                        <h5> {{$profile->username}} </h5>
                        @can('update', $profile)
                            <a href="{{ route('profile.edit', ['profile' => $profile]) }}">Edit</a>
                        @endcan
                    </div>
                    
                    <p>Bio: {{$profile->bio}}</p>
                    <p>Score: {{$profile->score}}</p>
                    <p>Account created: {{ $profile->created_at->diffForHumans() }} </p>
                    @if (!$profile->posts->isEmpty())
                        <p>Posted in:<p>
                        <ul>
                            @foreach ($profile->posts->unique('category_id') as $post)
                                <li><a href = "{{ route('categories.show', ['category' => $post->category]) }}"> {{$post->category->name}} </a> </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="navbar">
                        @can('update', $profile)
                            <a href="{{ route('logout') }}"><button class="btn">Logout</button></a>
                        @endcan

                        @can('delete', $profile)
                            <form action="{{ route('profile.destroy', ['profile' => $profile]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Delete Profile</button>
                            </form>
                        @endcan
                    </div>                    
                </div>
            </div>

            <div id="page-content-wrapper">
                @if ($profile->posts->isEmpty())
                    <div class="d-flex justify-content-center">
                        <h5>No posts yet!</h5>
                    </div>
                @else
                    <div class="d-flex justify-content-center">
                        <h5>Posts:</h5>
                    </div>
                    <ul>

                        @php
                            $posts = App\Post::where('profile_id', $profile->id)->simplePaginate(10);
                        @endphp

                        @foreach ($posts as $post)
                            <div class="post" onclick="location.href='{{ route('posts.show', ['category' => $post->category,'post' => $post->id ]) }}'">
                                <li class="list-unstyled"> 
                                    <h6> {{$post->title}} </h6>
                                    <p class="text-muted">{{ Illuminate\Support\Str::limit($post->body, $limit = 100, $end = '...') }}</p>
                                    <div class="navbar">
                                        <p class="postedBy">Posted by:
                                            <a href = "{{ route('profiles.show', ['profile' => $post->profile->username]) }}" class="user"> {{$post->profile->username}} </a></p>
                                        <p class="posted">In: <a href = "{{ route('categories.show', ['category' => $post->category->name]) }}" class="user"> {{$post->category->name}}</a></p>
                                        <p class="posted"> Posted: {{ $post->created_at->diffForHumans() }} </p>
                                    </div>
                                </li>
                            </div><br>
                        @endforeach
                    </ul>

                    <div class="d-flex justify-content-center">
                        {{$posts->links()}}
                    </div>

                @endif
                
            </div>
        </div>
        

        

        
        
        

        

        

    </div>
    

@endsection