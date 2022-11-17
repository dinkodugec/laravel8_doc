@extends('layouts.app')


@section('title', 'Create the post')


@section('content')

<form action="{{ route('posts.store') }}" method="POST">{{-- route is helper function --}}
@csrf

@include('posts.partials.form');

<div><input type="submit" value="Create"></div>
</form>

@endsection
