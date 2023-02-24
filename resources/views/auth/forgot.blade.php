@extends('layouts.admin')
@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-lg-3 ">
            
        </div>
        <div class="col-lg-6 shadow mt-5 mb-5 p-4">
            

            <div class="card-header">J'ai oublier mon mot de passe</div>
<div class="card-body">
    <form action="{{ route('post.forgot') }}" method="post">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" >
          @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>
      <p><a href="{{ route('forgot') }}">J'ai oublié mon mot de passe</a></p>
      <p><a href="{{ route('register') }}">Je n'ai pas de compte</a></p>
</div>

          
        </div>
        <div class="col-lg-3">
            
        </div>
    </div>
</div>

@endsection