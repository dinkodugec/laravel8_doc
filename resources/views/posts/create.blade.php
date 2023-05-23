@extends('layouts.home')


@section('title', 'Create the post')


@section('content')

<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('posts.partials.form')

    <input class="btn btn-primary mt-4" type="submit" value="Save a Post">


</form>

@endsection
