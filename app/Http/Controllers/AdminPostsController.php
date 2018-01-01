<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('can:access-admin-panel');
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Post::class);

    	$posts = Post::with('user');

    	if ($request->has('published')) {
    		$posts->where('published', $request->published);
    	}

    	$posts = $posts->get();

    	return view('adminposts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $post->load(['user', 'comments.user']);

        return view('adminposts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);        

        return view('adminposts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $updatedPost = $request->only('title', 'content', 'image_file');

        $path = $this->storeUploadedFile($request, 'image_file');

        $updatedPost['image_path'] = $path ?? $post->image_path;

        $post->update($updatedPost);

        return redirect()
            ->route('adminposts.show', $post)
            ->with('status', 'Post Updated.');
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('adminposts.index')
            ->with('status', 'Post Deleted');
    }

    public function publish(Request $request, Post $post)
    {
        $this->authorize('publish', Post::class);

        $post->published = true;
        $post->save();

        return back()->with('status', 'Post published');
    }

    public function unpublish(Request $request, Post $post)
    {
        $this->authorize('unpublish', Post::class);

        $post->published = false;
        $post->save();

        return back()->with('status', 'Post unpublished');
    }

    private function storeUploadedFile(Request $request, $file, $dir = 'images')
    {
        if ($request->hasFile($file)) {
            $path = $request->file($file)->store($dir);
        }

        return $path ?? null;
    }


}
