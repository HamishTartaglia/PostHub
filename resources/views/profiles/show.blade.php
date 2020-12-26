@extends('layouts.app')

@section('title', $profile->username)

@section('content')

    <div class="container">

        <p>Bio: {{$profile->bio}}</p>

        @can('update', $profile)
            <button><a href="{{ route('profile.edit', ['profile' => $profile]) }}"> Edit</a></button>
        @endcan

        <p>Score: {{$profile->score}}</p>
        <p>Account created: {{ $profile->created_at->diffForHumans() }} </p>
        <p>Posts:</p>

        <ul>
            @foreach ($profile->posts as $post)

                <li> <a href = "{{ route('posts.show', ['category' => $post->category,'post' => $post->id ]) }}"> {{$post->title}} </a> </li>
            
            @endforeach

        </ul>

        <p>Posted in:<p>
        
        <ul>
            @foreach ($profile->posts->unique('category_id') as $post)

                <li><a href = "{{ route('categories.show', ['category' => $post->category]) }}"> {{$post->category->name}} </a> </li>
                
            @endforeach

        </ul>

        @can('update', $profile)
            <a href="{{ route('logout') }}">Logout</a>
        @endcan

        @can('delete', $profile)
            <form action="{{ route('profile.destroy', ['profile' => $profile]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Profile</button>
            </form>
        @endcan

    </div>
    

@endsection