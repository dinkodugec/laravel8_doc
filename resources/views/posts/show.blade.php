@extends('layouts.app')

@section ('title', $post['title'])


@section('content')

@if($post['is_new'])
<div>A new blog post! Using If!</div>
@else
<div>Blog post is old</div>
@endif

@unless($post['is_new'])
<div>It is an old post using unless</div>
@endunless()

@isset($post['has_comments'])
<div>The post has some comments....using isser</div>
@endisset



<h1>{{ $post['title'] }}</h1>
<h1>{{ $post['content'] }}</h1>
@endsection