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
                <a href="{{ route('post.edit', ['category' => $post->category,'post' => $post]) }}" >
                    <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </h5>    
                </a>
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