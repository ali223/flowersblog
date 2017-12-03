<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $this->authorize('create', [Comment::class, $post]);

        $comment = $request->validate([
            'text' => 'required'
        ]);

        $comment['user_id'] = auth()->id();

        $post->comments()->create($comment);

        return back()->with('status', 'Comment saved.');
    }

}
