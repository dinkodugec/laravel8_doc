<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPosts;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPosts $post, StoreComment $request)
    {
        // Comment::create()
        $post->comments()->create([
            'content' => $request->input('content'), //comments attribute
            'user_id' => $request->user()->id
        ]);

        $request->session()->flash('status', 'Comment was created!');

        return redirect()->back()
        ->withStatus('Comment was created!');;
    }
}