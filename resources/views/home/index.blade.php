@extends('layouts.app')

@section ('title', 'Home Page')

@guest
@if (Route::has('register'))
    <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
@endif
<a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
@else
<a class="p-2 text-dark" href="{{ route('logout') }}"
    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
    >Logout {{ Auth::user()->name }}</a>

<form id="logout-form" action={{ route('logout') }} method="POST"  {{-- work only with post method --}}
    style="display: none;">
    @csrf
</form>
@endguest

@section('content')
<h1>Hello from section</h1>
@endsection
