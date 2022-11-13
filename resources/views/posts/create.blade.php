@extends('layouts.app')


@section('title', 'Create the post')


@section('content')

<form action="{{ route('posts.store') }}" method="POST">{{-- route is helper function --}}
@csrf
<div><input type="text" name="title"></div>
<div><textarea name="content" id="" cols="30" rows="10"></textarea></div>
<div><input type="submit" value="Create"></div>
</form> 

@endsection
