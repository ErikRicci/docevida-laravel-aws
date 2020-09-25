@extends('includes.app')

@section('title', 'Home')

    <body>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Doce Vida 🧁</h1>
                <p class="lead">O que os olhos vêem, a barriga ronca</p>
            </div>
        </div>
        <nav style="padding-left: 20px" class="navbar-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/') }}">Home</a>
            <a class="navbar-brand" href="{{ route('loja') }}">Lojinha</a>
            <a class="navbar-brand" href="{{ url('/') }}">Admin</a>
          </nav>
    </body>
