@extends('layouts.app')

@section('content')


    <div class="container px-4">
        <div class="row"id="posts-title">
            <div class="col" id="delete-post">
                @can('delete', $post)
                    <form action="{{ route('post.destroy', ['post' => $post]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" id="delete-post-btn">Delete Post</button>
                    </form>
                @endcan
            </div>
            
            <div class="col" id="post-title-col">
                <h5>{{$post->title}}</h5>
            </div>

            <div class="col" id="edit-post">
                @can('update', $post)
                    <a href="{{ route('post.edit', ['category' => $post->category,'post' => $post]) }}" >
                        <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </h5>    
                    </a>
                @endcan 
            </div>             
        </div>

        <br>

        <div class="d-flex justify-content-center" id="post-body-text">
            <h6>{{$post->body}}</h6>       
        </div>
        <div class="d-flex justify-content-center" id="post-pic">
            @if (isset($post->photo)) 
                @php
                    $filename = $post->photo->filename;
                    $filename = ltrim($filename, 'public');
                @endphp 
                <img src ="{{ asset($filename)}}">
            @endif
        </div>


        <div class="row" id="post-info">
            <div class="col">
                <p class="postedBy">Posted by:
                    <a href = "{{ route('profiles.show', ['profile' => $post->profile->username]) }}" class="user"> {{$post->profile->username}} </a>
                </p>
            </div>
            <div class="col">
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
            </div>
            <div class="col">
                <p class="posted">Score: {{ $post->score }} </p>
            </div>
            <div class="col">
                <p class="posted">Posted: {{ $post->created_at->diffForHumans() }} </p>
            </div>
        </div>

        <div id="comments">
            <h6>Comments:</h6>

            @if (Auth::check())
                <textarea type="text" v-model="newComment"  id="comment-text" required class="form-control @error('body') is-invalid @enderror" name="body">{{ old('body') }}</textarea>
                <br>
                <div v-if="errors !== ''">
                    <div class="alert alert-danger" role="alert" id="comment-alert">
                        <strong>@{{errors.substring(60)}}</strong>
                    </div>
                </div>
                <button @click="createComment" class="btn">Submit</button>
                
            @endif 
            @if ($post->comments->isEmpty())
                <p>No Comments Yet!</p>
            @else
                <div class="row">
                    <div class="col" id="coms">
                        <div v-for="comment in comments" class="comment"> 
                            <div class="row">
                                <div class="col">
                                    <p>@{{ comment.body }}</p>
                                </div>
                                <div class="col">
                                    @if (Auth::check())
                                    <div v-for="profile in profiles" v-if="profile.id === comment.id">
                                        <div v-if="profile.profile_id === <?php echo Auth::id(); ?>" id="edit-comm">
                                            <div class="row px-2">
                                                <div class="col" id="edit-comment">
                                                    <h5>
                                                        <a v-bind:href="getEditLink(comment.id)" class="edit-link">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                            </svg>
                                                        </a>
                                                    </h5> 
                                                </div>
                                                <div class="col"id="del-comment">
                                                    <button type="submit" class="empty-button" @click="deleteComment(comment.id)" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0065bd" class="bi bi-trash" viewBox="0 0 16 16"id="delete-comment">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else-if = "<?php echo $post->profile_id; ?> ===  <?php echo Auth::id(); ?>" id="edit-comm">
                                            <div class="col">
                                                <button type="submit" class="empty-button" @click="deleteComment(comment.id)" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0065bd" class="bi bi-trash" viewBox="0 0 16 16"id="delete-comment">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div> 
                                    </div>
                                        
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div v-for="profile in profiles" v-if="profile.id === comment.id">
                                        <p class="posted">Posted By: 
                                            <a v-bind:href="getUserLink(profile.username)" class="user">
                                                @{{profile.username}}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="col" id="created-comm">
                                    <p class="posted">
                                        Posted: @{{ comment.created_at.substring(0,10) }}
                                        at @{{ comment.created_at.substring(11,16) }}
                                    </p>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div>
        <a href="#app">
            <button class="btn" id="back-to-top">Back to top</button>
        </a>
    </div>

    <script>
        var app = new Vue({
            el: "#comments",
            data: {
                comments: [],
                newComment: '',
                profiles: [],
                errors: '',
            },
            mounted(){
                axios.get("{{ route('api.comments.index', $post) }}")
                .then( response =>{
                    this.comments = response.data;
                    this.getProfiles(this.comments[0].post_id);
                })
                .catch(response => {
                        console.log(response);
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
                            this.getProfiles(this.comments[0].post_id);
                        })
                        .catch(errors => {
                            this.errors = JSON.stringify(errors.response.data).slice(0,-5);
                        })
                    @endif
                },
                getProfiles: function(id){
                    axios.get('https://posthub.test/api/comment/' + id)
                        .then(response =>{
                            this.profiles = response.data;
                        })
                        .catch(response => {
                            console.log(response)
                        })
                },
                getEditLink: function(id){
                    return 'https://posthub.test/comments/' + id + '/edit';
                },
                getUserLink: function(username){
                    return 'https://posthub.test/profiles/' + username;
                },
                deleteComment: function(comment){
                    axios.delete('https://posthub.test/api/comment/' + comment)
                    .then(response =>{
                        axios.get("{{ route('api.comments.index', $post) }}")
                        .then( response =>{
                            this.comments = response.data;
                            this.getProfiles(this.comments[0].post_id);
                        })
                        .catch(response => {
                            console.log(response)
                        })
                    })
                    .catch(response => {
                        console.log(response);
                    })
                }
            }
        });

    </script>

@endsection