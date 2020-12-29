@extends('layouts.app')

@section('content')


    <div class="container p-4">
        <div class="navbar"id="posts-title">
            @can('delete', $post)
                <form action="{{ route('post.destroy', ['post' => $post]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Delete Post</button>
                </form>
            @endcan


            <h5>{{$post->title}}</h5>

            @can('update', $post)
                <a href="{{ route('post.edit', ['category' => $post->category,'post' => $post]) }}" ><button class="btn"> Edit Post </button></a>
            @endcan 
            
        </div>

        <br>

        <div class="d-flex justify-content-center" id="post-body-text">
            <h6>{{$post->body}}</h6>   
        </div>


        <div class="navbar" id="post-info">
            <p class="postedBy">Posted by:
                <a href = "{{ route('profiles.show', ['profile' => $post->profile->username]) }}" class="user"> {{$post->profile->username}} </a>
            </p>

            <p class="posted">
                Tags:
                @if($post->tags->isEmpty())
                    None
                @else
                    @foreach ($post->tags as $tag) 
                        {{$tag->name}} 
                    @endforeach
                @endif
            </p>
            <p class="posted">Posted: {{ $post->created_at->diffForHumans() }} </p>
        </div>
    </div>



    

    <p>Comments:</p>

    <div id="comments">
        @if (Auth::check())
            <input type="text" v-model="newComment">
            <button @click="createComment">Submit</button>
        @endif

        
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
                    @if(Auth::check())
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
                    @endif
                }
            }
        });

    </script>

@endsection