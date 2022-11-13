@extends('layouts.app')


@section('title', 'Create the post')


@section('content')

<form action="{{ route('posts.store') }}" method="POST">{{-- route is helper function --}}
@csrf
<div><input type="text" name="title"></div>
@error('title')
   <div>{{ $message }}</div>
@enderror
<div><textarea name="content" id="" cols="30" rows="10"></textarea></div>
@if ($errors->any())
    <div>
        <ul>
            @foreach ( $errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div><input type="submit" value="Create"></div>
</form>

@endsection
