<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('user')->latest();

        $showMyPosts = 0;

        if (auth()->check() && $request->myposts) {
            $posts->where('user_id', auth()->id());
            $showMyPosts = 1;
        }

        $posts = $posts->get();

        return view('posts.index', [
                'posts' => $posts,
                'showMyPosts' => $showMyPosts
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $this->validatePost($request);

        $path = $this->storeUploadedFile($request, 'image_file');

        $post['image_path'] = $path ?? null;

        auth()->user()->posts()->create($post);

        return redirect()
            ->route('posts.index', ['myposts' => 1])
            ->with('status', 'Post Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);        

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $updatedPost = $this->validatePost($request);

        $path = $this->storeUploadedFile($request, 'image_file');

        $updatedPost['image_path'] = $path ?? $post->image_path;

        $post->update($updatedPost);

        return redirect()
            ->route('posts.show', $post)
            ->with('status', 'Post Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('posts.index', ['myposts' => 1])
            ->with('status', 'Post Deleted');
    }

    private function validatePost(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:180',
            'content' => 'required',
            'image_file' => 'nullable|image'
        ]);
    }

    private function storeUploadedFile(Request $request, $file, $dir = 'images')
    {
        if ($request->hasFile($file)) {
            $path = $request->file($file)->store($dir);
        }

        return $path ?? null;
    }

}
