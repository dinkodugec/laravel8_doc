


{{-- @if($loop->even)
<div>{{ $key}} . {{ $post->title }}</div>
@else
<div style="background-color: silver">{{ $key}} . {{ $post->title }}</div>
@endif --}}

@foreach ($posts as $post )

        <p>
            <h3>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
            </h3>
        </p>
        <p class="">Added({{ $post->created_at->diffForHumans() }})
            by {{ $post->user->name }}
            </p>

@endforeach


<div>



    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
     @csrf
     @method('DELETE')
     <input type="submit" value="delete">
    </form>

</div>
