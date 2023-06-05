@extends('layouts.home')

@section ('title','Blog Posts')


@section('content')


@forelse($posts as $key => $post)
@include('posts.partials.post')
@empty
No posts Found
@endforelse


@endsection
