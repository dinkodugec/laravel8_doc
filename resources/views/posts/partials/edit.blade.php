@extends('layouts.home')


@section('title', 'Update the post')


@section('content')

<form action="{{ route('post.update', $post) }}"  enctype="multipart/form-data"  method="POST"> {{-- route is helper function --}}
@csrf
@method('PUT')
@include('posts.partials.form')

<div><input type="submit" value="Update"></div>
</form>

@endsection
