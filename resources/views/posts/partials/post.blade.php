


{{-- @if($loop->even)
<div>{{ $key}} . {{ $post->title }}</div>
@else
<div style="background-color: silver">{{ $key}} . {{ $post->title }}</div>
@endif --}}

{{-- <div class="row">
    <div class="col-8">
        @foreach ($posts as $post )

                <p>

                    <h3>

                        @if ($post->trashed())
                        <del>
                        @endif
                        <a class="{{ $post->trashed() ? 'text-muted' : '' }}" href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                        @if ($post->trashed())
                        <del>
                        @endif
                    </h3>
                </p>
                <p class="">Added({{ $post->created_at->diffForHumans() }})
                    by {{ $post->user->name }}
                    </p>




        <div>

            <div>
                @tags(['tags'=>$post->tags])@endtags  {{-- component named tags- this is way to show list of tags --}}
            </div>

        {{--   @cannot()
            <p>You can not delete that post</p>
            @endcannot --}}

  {{--           @can('update', $post)
            <form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="delete">
            </form>
            @endcan

        </div>
        @endforeach
    </div> --}}
   {{--  <div class="col-4">
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                What people are currently talking about
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostCommented as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('post.show', ['post' => $post->id]) }}">
                                        {{ $post->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
               </div>

               <div class="row mt-4">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Most Active</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            Users with most posts written
                        </h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostActive as $post)
                            <li class="list-group-item">
                                {{ $user->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
           </div>

           <div class="row mt-4">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Most Active Last Month</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Users with most posts written in the month
                    </h6>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($mostActiveLastMonth as $user)
                        <li class="list-group-item">
                            {{ $user->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
      </div>
    </div> --}}
</div>

<div class="container  ">

@forelse ($posts as $post)
<p>
    <h3>
        <a class="btn btn-primary mt-4" href="{{ route('post.show', ['post' => $post->id]) }}"> <h3 class="">{{ $post->title }}</h3> </a>
    </h3>

    <p class="text-muted">
        Added {{ $post->created_at->diffForHumans() }}
        by {{ $post->user->name }}
        <p>{{ $post->id }}</p>
    </p>

    @if($post->comments_count)
        <p>{{ $post->comments_count }} comments</p>
    @else
        <p>No comments yet!</p>
    @endif

    @if($post->onlyTrashed)
    <p>Trashed!!</p>
@else
    <p>No comments yet!</p>
@endif




        <a href="{{ route('post.edit', ['post' => $post->id]) }}"
            class="btn btn-info">
            Edit
        </a>


    {{-- @cannot('delete', $post)
        <p>You can't delete this post</p>
    @endcannot --}}

   {{--  @can('delete', $post)
        <form method="POST" class="fm-inline"
            action="{{ route('posts.destroy', ['post' => $post->id]) }}">
            @csrf
            @method('DELETE')

            <input type="submit" value="Delete!" class="btn btn-primary"/>
        </form>
    @endcan --}}

        <form method="POST" class="fm-inline"
            action="{{ route('post.destroy', ['post' => $post->id]) }}">
            @csrf
            @method('DELETE')

            <button type="submit"  class="btn btn-outline-danger">Delete</button>
        </form>

       

</p>
@empty
<p>No blog posts yet!</p>
@endforelse
