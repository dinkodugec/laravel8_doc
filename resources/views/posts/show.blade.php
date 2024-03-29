@extends('layouts.home')

@section ('title', $post->title)


@section('content')
<div class="row">
    <div class="col-8">

        @if($post->image)
        <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
            <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
        @else
            <h1>
        @endif

        @if($post->image)
         </h1>
       </div>
        @else
            </h1>
        @endif


{{-- <h1>
  {{ $post->title }}
  @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
      Brand new Post!
  @endbadg
</h1>

@tags(['tags'=>$post->tags])@endtags

@unless($post['is_new'])
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

{{-- <img src="{{ $post->image->url() }}" /> --}}

<div>
    <form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"  class="btn btn-outline-danger">Delete</button>
        {{-- <input class="btn btn-danger mt-4" type="submit" value="delete"> --}}
        </form>
</div>


{{-- <h1>{{ $post->title }}</h1>
<h1>{{ $post->content }}</h1>  --}}

<h1>{{ $post->title }}</h1>
<br>
<p>{{ $post->content }}</p>
<br>
<p> Currently read by {{ $counter }} people</p>

<br>
<p>Added {{ $post->created_at->diffForHumans() }}</p>
<br>



@if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5 )
      @component('badge')

      @endcomponent
@endif


<br>
<h4>Comments</h4>

@include('comments._form')

@forelse($post->comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <p class="text-muted">
        added {{ $comment->created_at->diffForHumans() }}
    </p>
    <br>
@empty
    <p>No comments yet!</p>
@endforelse

  </div>
</div>
@endsection
