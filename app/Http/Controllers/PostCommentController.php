<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted as EventsCommentPosted;
use App\Http\Requests\StoreComment;
use App\Jobs\NotifyyUsersPostWasCommented;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use App\Models\BlogPosts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPosts $post, StoreComment $request)
    {
        // Comment::create()
        $comment = $post->comments()->create([
            'content' => $request->input('content'), //comments attribute
            'user_id' => $request->user()->id
        ]);

        event(new CommentPosted($comment));


  /*       Mail::to($post->user)->send( //it accept instance of CommentPosted class, which extends a mailable class
            new CommentPostedMarkdown($comment)
        ); */

            // Mail::to($post->user)->queue(
        //     new CommentPostedMarkdown($comment)
        // );

        $when = now()->addMinutes(1);

        Mail::to($post->user)->later(
            $when,
            new CommentPostedMarkdown($comment)
         );





        return redirect()->back()
        ->withStatus('Comment was created!');;
    }
}
