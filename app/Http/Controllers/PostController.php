<?php

namespace App\Http\Controllers;

use App\Category;
use App\NasaPicture;
use App\Post;
use App\Photo;
use Illuminate\Support\Facades\Auth;
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
        $posts = Post::simplePaginate(10);
        return(view('posts.index',['posts' => $posts]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
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
            'title' => 'required|max:100|string' ,
            'body' => 'required|max:1000',
            'image' => 'mimes:jpeg,bmp,png'
        ]);

        $category = Category::findOrFail($category);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->profile_id = Auth::user()->id;
        $post->category_id = $category->id;
        $post->save();

        if ($request->hasFile('image')) {
            $validatedData['image']->store('images','public');
            $photo = new Photo;
            $photo->filename = "public/images/".$validatedData['image']->hashName();
            $photo->photoable_id = $post->id;
            $photo->photoable_type = Post::class;
            $photo->save();
        }

        $tags = $request->input('tags');
        if($tags != null){
            foreach($tags as $tag){
                $post->tags()->attach($tag);
            }
        }
        
        $profile = $post->profile;
        $profile->score = $profile->score + 10;
        $profile->save();
        
        return redirect()->route('posts.show', ['category' => $category, 'post' => $post])->with('message','Post created!');
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
        ]);

        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
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

        $profile = $post->profile;
        $profile->score = $profile->score - 10;
        $profile->save();

        $post->delete();

        return redirect()->route('categories.show',['category' => $category])->with('message','Post Deleted!');
    }

    public function nasaAPOD(NasaPicture $nasa)
    {
        $photo = $nasa->getPhoto();
        $author = $nasa->getAuthor();
        $description = $nasa->getDescription();
        $date = $nasa->getDate();
        $title = $nasa->getTitle();

        return(view('posts.nasa',compact('photo','author','description','date','title')));
    }
}
