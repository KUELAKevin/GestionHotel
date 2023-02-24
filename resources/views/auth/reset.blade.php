@extends('layouts.admin')
@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="container">
    <div class="row ">
        <div class="col-lg-3 ">
            
        </div>
        <div class="col-lg-6 shadow mt-5 mb-5 p-4">
            

            <div class="card-header">Réinitialisation de mot de passe</div>
<div class="card-body">
    <form action="{{ route('post.reset') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $password_reset->token }}">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" >
          @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                  <div class="error">{{ $message }}</div>
              @enderror
        </div>

        <div class="mb-3">
            <label for="password">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>
</div>

          
        </div>
        <div class="col-lg-3">
            
        </div>
    </div>
</div>

@endsection