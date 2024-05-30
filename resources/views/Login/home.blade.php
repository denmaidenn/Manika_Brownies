@extends('layout')
@section('content')

@auth
<p>Welcome <b>{{ Auth::user()->name }}</b> </p>
<a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
@endauth

@guest
<a class="btn btn-primary" href="{{ route('login') }}">Login</a>
@endguest
@endsection