@extends('layouts.app')

@section ('title', 'Contact Page')

@section('content')
<h1>Contact Page</h1>

@can('home.secret')  {{--  this only see admin, because we define a gate in aurhService Provider, name home.secret --}}
<p>
  <a href="{{ route('secret') }}">
    Go to special contact details!
  </a>
</p>
@endcan
@endsection
