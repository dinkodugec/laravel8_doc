@extends('layouts.app')

@section ('title', $posts['title'])


@section('content')

<h1>
  {{ $post->title }}
  @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
      Brand new Post!
  @endbadg
</h1>

@tags(['tags'=>$post->tags])@endtags

@unless($posts['is_new'])
<div>It is an old post using unless</div>
@badge
Old Post!
@endbadge
@endunless()

{{-- @isset($posts['has_comments'])
<div>The post has some comments....using isser</div>
@badge
Brand new Post!
@endbadge
@endisset --}}

<img src="{{ $post->image->url() }}" />



<h1>{{ $posts['title'] }}</h1>
<h1>{{ $posts['content'] }}</h1>
@endsection
