@extends('layouts.app')

@section ('title', $post['title'])


@section('content')
<h1>{{ $post['title'] }}</h1>
<h1>{{ $post['content'] }}</h1>
@endsection