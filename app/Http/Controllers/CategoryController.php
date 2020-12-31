<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return(view('categories.index',['categories' => $categories]));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->simplePaginate(10);
        return view('categories.show', ['category' => $category], compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function newest(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->orderBy('created_at', 'DESC')->simplePaginate(10);
        return view('categories.show', ['category' => $category], compact('posts'));
    }

    public function oldest(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->orderBy('created_at', 'ASC')->simplePaginate(10);
        return view('categories.show', ['category' => $category], compact('posts'));
    }

    public function top(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->orderBy('score', 'DESC')->simplePaginate(10);
        return view('categories.show', ['category' => $category], compact('posts'));
    }
}
