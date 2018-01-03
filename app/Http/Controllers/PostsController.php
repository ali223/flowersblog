<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('redirect-admin');

        $this->middleware('can:access-member-area', [
                'except' => ['index', 'show']
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('user')
                    ->latest();

        $showMyPosts = 0;

        if (auth()->check() && $request->myposts) {
            $posts->createdBy(auth()->id());
            $showMyPosts = 1;
        } else {
            $posts->published();
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
    public function store(PostRequest $request)
    {
        $post = $request->only('title', 'content', 'image_file');

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
    public function show($id)
    {
        $post = Post::with(['user', 'comments.user']);

        if( auth()->check()) {
            $post->byUserAndAllPublished(auth()->id());
        } else {
            $post->published();
        }

        $post = $post->findOrFail($id);
        
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
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $updatedPost = $request->only('title', 'content', 'image_file');

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

    private function storeUploadedFile(Request $request, $file, $dir = 'images')
    {
        if ($request->hasFile($file)) {
            $path = $request->file($file)->store($dir);
        }

        return $path ?? null;
    }

}
