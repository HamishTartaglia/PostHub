<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Category;
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
            'profile_id' => 'required|integer',
        ]);

        $post = Post::findOrFail($post);

        $comment = new Comment;
        $comment->body = $validatedData['body'];
        $comment->profile_id = $validatedData['profile_id'];
        $comment->post_id = $post->id;
        $comment->save();

        session()->flash('message','Comment posted!');
        return redirect()->route('posts.show', ['category' => $post->category,'post' => $post->id ]);
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
        //
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
        //
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

        return redirect()->route('posts.show', ['category' => $category,'post' => $post])->with('message','Post Deleted!');
    }
}
