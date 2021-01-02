<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\CommentAdded;
use App\Post;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return(view('comments.index',['comments' => $comments]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post)
    {
        $validatedData = $request->validate([
            'body' => 'required|max:200',
        ]);

        $post = Post::findOrFail($post);

        $comment = new Comment;
        $comment->body = $validatedData['body'];
        $comment->profile_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();
        
        return redirect()->route('posts.show', ['category' => $post->category,'post' => $post->id ])->with('message','Comment posted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'body' => 'required|max:200',
        ]);

        $comment->body = $validatedData['body'];
        $comment->profile_id = Auth::id();
        $comment->save();

        return redirect()->route('posts.show', ['category' => $comment->post->category,'post' => $comment->post])->with('message','Comment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $category = $comment->post->category;
        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', ['category' => $category,'post' => $post])->with('message','Comment Deleted!');
    }

    public function apiIndex(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get(); 
        return $comments;
    }

    public function apiStore(Request $request, Post $post, $profile)
    {
        $validatedData = $request->validate([
            'body' => 'required|max:200',
        ]);

        $profile = Profile::findOrFail($profile);
        
        $comment = new Comment;
        $comment->body = $validatedData['body'];
        $comment->profile_id = $profile->id;
        $comment->post_id = $post->id;
        $comment->save();

        $post->score = $post->score + 10;
        $post->save();

        $profile->score = $profile->score + 10;
        $profile->save();

        $poster = $post->profile;
        $poster->score = $poster->score + 10;
        $poster->save();

        event(new CommentAdded($comment,$post));

        return $comment;
    }
    
    public function apiProfile(Post $post)
    {
        $profiles = [];
        foreach($post->comments as $comment){
            $profiles[] = [
                'id' => $comment->id,
                'username' => $comment->profile->username,
                'profile_id' => $comment->profile_id,
            ];
        }
        return response()->json($profiles);
    }

    public function apiDestroy(Comment $comment)
    {
        $profile = $comment->profile;
        $profile->score = $profile->score - 10;
        $profile->save();

        $profile = $comment->post->profile;
        $profile->score = $profile->score - 10;
        $profile->save();

        $comment->delete();
        return true;
    }
}
