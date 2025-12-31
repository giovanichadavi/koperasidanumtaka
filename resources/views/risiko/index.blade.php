@extends('adminlte::page')

@section('title', 'Risiko')

@section('content_header')
    <h1>Halaman Risiko</h1>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection


@section('navbar-right')
<li class="nav-item">
    <a class="nav-link" href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@endsection