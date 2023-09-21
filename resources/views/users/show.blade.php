@extends('layouts.home')

@section('content')
    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ? $user->image->url() : '' }}" style="width: 128px;
                 height: 128px;" class="img-thumbnail avatar" />
        </div>
        <div class="col-8">
            <h3>{{ $user->name }}</h3>


            <p>Currently viewed by {{ $counter }} other users</p>
        </div>
    </div>
@endsection
