<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact([
            'posts'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact([
            'categories',
            'tags'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Image Upload and stores the name of the image
        $image = $request->file('image')->store('posts');
        //php artisan storage:link
        //Create Post
        $post=Post::create([
            'title'=>$request->title,
            'excerpt'=>$request->excerpt,
            'content'=>$request->content,
            'image'=>$image,
            'user_id'=>auth()->id(),
            'category_id'=>$request->category_id,
            'published_at'=>$request->published_at

            
        ]);
        // dd($request->tags);
        $post->tags()->attach($request->tags);

        session()->flash('success', 'Post Created Successfully');
        
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags= Tag::all();
        $categories = Category::all();
        return view('posts.edit', compact([
            'categories',
            'post',
            'tags'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data= $request->only(['title', 'excerpt', 'content', 'published_at', 'category_id']);
        // dd($data);
        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }

        $post->update($data);

        // if($request->tags){
            $post->tags()->sync($request->tags);
        // }
        session()->flash('success', 'Post updated successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->deleteImage();
        $post->forceDelete();
        session()->flash('success', 'Post Deleted Successfully');
        return redirect()->back();
    }
}
