@extends('layouts.app')

@section('content')

    <div class="container px-4">

        <div class="d-flex" id="wrapper">

            <div class="border-right shadow p-3 mb-5 bg-white" id="sidebar-wrapper">
                @if (isset($profile->photo)) 
                <div class="row">
                    @php
                        $filename = $profile->photo->filename;
                        $filename = ltrim($filename, 'public');
                    @endphp 
                    <div class="col">
                        <img src ="{{ asset($filename)}}" id="med-img" alt="avatar">
                    </div>
                    @can('update', $profile)
                        <div class="col"id="delete-avatar">
                            <form method="POST" action="{{ route('photo.destroy', ['photo' => $profile->photo])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="empty-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0065bd" class="bi bi-trash" viewBox="0 0 16 16" alt="delete-button">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                </button>
                            </form>
                        </div>
                    @endcan
                    
                </div>
                <br>
                @endif
                <div class="navbar">
                    <h5> {{$profile->username}} </h5>
                    @can('update', $profile)
                        <a href="{{ route('profile.edit', ['profile' => $profile]) }}" class="edit-link">
                            <h5>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16" alt="edit-button">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </h5>
                        </a>
                    @endcan
                </div>
                
                <h6>{{$profile->bio}}</h6>
                <p>Score: {{$profile->score}}</p>
                <p>Account created: {{ $profile->created_at->diffForHumans() }} </p>
                @if (!$profile->posts->isEmpty())
                    <h5>Posted in:<h5>
                    <ul>
                        @foreach ($profile->posts->unique('category_id') as $post)
                            <a href = "{{ route('categories.show', ['category' => $post->category]) }}" class="category-link"> 
                                <p class="admin-of">{{$post->category->name}} </p>
                            </a>
                        @endforeach
                    </ul>
                @endif

                @php
                    $admins = App\Admin::where('profile_id',$profile->id)->first()
                @endphp

                @if ($admins)
                    <h5>Admin of:</h5>
                    <ul>
                        @foreach ($profile->admin->categories as $category)
                            <a href = "{{ route('categories.show', ['category' => $category]) }}" class="category-link"> 
                                <p class="admin-of">{{$category->name}} </p>
                            </a>
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

            <div id="page-content-wrapper" class="border-right shadow p-3 ms-4 bg-white">
                @if ($profile->posts->isEmpty())
                    <div class="d-flex justify-content-center" id="posts-title">
                        <h5>No posts yet!</h5>
                    </div>
                @else
                    <div id="posts-title">
                        <h5 id="username">Posts by {{$profile->username}}:</h5>
                    </div>
                    <br>
                    <ul>

                        @php
                            $posts = App\Post::where('profile_id', $profile->id)->simplePaginate(10);
                        @endphp

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
                                                <img src ="{{ asset($filename)}}" id="small-img"/>
                                            @endif
                                        </div>
                                    </div>

                                    
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