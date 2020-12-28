@extends('layouts.app')

@section('content')

    <ul>
        <li>{{$post->body}}</li>
        <li>Score: {{$post->score}}</li>
        <li>By: <a href = "{{ route('profiles.show', ['profile' => $post->profile]) }}"> {{$post->profile->username}} </a> </li>
        <li>From: <a href = "{{ route('categories.show', ['category' => $post->category]) }}"> {{$post->category->name}} </a> </li>
        <li>Tags:
            <ul>
                @foreach ($post->tags as $tag)

                    <li>{{$tag->name}} </a> </li>
     
                @endforeach
            </ul>
    </ul>

    @can('update', $post)
        <button><a href="{{ route('post.edit', ['category' => $post->category,'post' => $post]) }}"> Edit Post </a></button>
    @endcan 

    @can('delete', $post)
        <form action="{{ route('post.destroy', ['post' => $post]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Post</button>
        </form>
    @endcan

    <p>Comments:</p>

    <div id="comments">
        <input type="text" v-model="newComment">
        <button @click="createComment">Submit</button>
        <ul>
            <li v-for="comment in comments">@{{ comment.body }}</li>
        </ul>
    
    </div>
    
    <script>
        var app = new Vue({
            el: "#comments",
            data: {
                comments: [],
                newComment: ''
            },
            mounted(){
                axios.get("{{ route('api.comments.index', $post) }}")
                .then( response =>{
                    this.comments = response.data;
                })
                .catch(response => {
                    console.log(response)
                })
            },
            methods: {
                createComment: function(){
                    axios.post("{{ route('api.comments.store', ['post' => $post, 'profile' => Auth::id()]) }}",
                    {
                        body:this.newComment
                    })
                    .then(response => {
                        this.comments.push(response.data);
                        this.newComment = '';
                    })
                    .catch(response => {
                        console.log(response);
                    })
                }
            }
        });

    </script>

@endsection