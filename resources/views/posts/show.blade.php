@extends('layouts.app')

@section ('title', $posts['title'])


@section('content')

@if($posts['is_new'])
<div>A new blog post! Using If!</div>
@else
<div>Blog post is old</div>
@endif

@unless($posts['is_new'])
<div>It is an old post using unless</div>
@badge
Old Post!
@endbadge
@endunless()

@isset($posts['has_comments'])
<div>The post has some comments....using isser</div>
@badge
Brand new Post!
@endbadge
@endisset



<h1>{{ $posts['title'] }}</h1>
<h1>{{ $posts['content'] }}</h1>
@endsection
