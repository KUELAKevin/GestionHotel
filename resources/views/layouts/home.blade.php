@extends('layouts.admin')
@section('content')

      @guest
        <h1 class="display-6 text-center" my-5>Le site Gestion Hotel est à votre disposition</h1>
      @endguest
      @auth
        <h1 class="display-6 text-center">Bienvenu {{ auth()->user()->name }} {{ auth()->user()->prenom }}</h1>
      @endauth
@endsection