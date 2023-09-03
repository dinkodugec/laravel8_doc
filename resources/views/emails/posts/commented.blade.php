<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

  <p>Hi {{ $comment->commentable->user->name }}</p>

<p>
    <img src="{{ $message->embed($comment->user->image->url()) }}"/>
    Someone has commented on your blog post
    <a href="{{ route('post.show', ['post' => $comment->commentable->id]) }}">
        {{ $comment->commentable->title }}
    </a>
</p>

<hr/>

<p>
   <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">
        {{ $comment->user->name }}
    </a> said: -
</p>

<p>
    "{{ $comment->content }}"
</p>
