<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::simplePaginate(5);
        return(view('posts.index',['posts' => $posts]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        //$categories = Category::orderBy('name', 'asc')->get();
        return view('posts.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $category)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'body' => 'required|max:1000',
            'profile_id' => 'required|integer',
        ]);

        $category = Category::findOrFail($category);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->profile_id = $validatedData['profile_id'];
        $post->category_id = $category->id;
        $post->save();

        session()->flash('message','Post created!');
        return redirect()->route('categories.show', ['category' => $post->category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Post $post)
    {
        return view('posts.show', ['category' => $category,'post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Post $post)
    {
        return view('posts.edit', ['category' => $category, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'body' => 'required|max:1000',
            'profile_id' => 'required|integer',
        ]);

        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->profile_id = $validatedData['profile_id'];
        $post->save();

        return redirect()->route('posts.show', ['category' => $category,'post' => $post])->with('message','Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $category = $post->category;
        $post->delete();

        return redirect()->route('categories.show',['category' => $category])->with('message','Post Deleted!');
    }
}
