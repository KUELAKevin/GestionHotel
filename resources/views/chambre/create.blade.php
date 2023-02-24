@extends('layouts.admin')
@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-lg-3 ">
            
        </div>
        <div class="col-lg-6 shadow mt-5 mb-5 p-4">
            

            <div class="card-header">Ajouter une chambre</div>
<div class="card-body">
    <form action="{{ route('chambres.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="numero_porte" class="form-label">Numero de porte</label>
            <input type="text" name="numero_porte" class="form-control" value="{{ old('numero_porte') }}" >
            @error('numero_porte')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select name="category" class="form-control">
                <option value=""></option>
                @foreach ($categories as $category )
                    <option value="{{ $category->id }}" 
                        @if (old('category')== $category->id)
                            selected
                        @endif    
                    >{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="disponibilite">Disponibilité</label>
            <select name="disponibilite" class="form-control">
                <option value=""></option>
                @foreach ($disponibilites as $disponibilite )
                    <option value="{{ $disponibilite->id }}"
                        @if (old('disponibilite')== $disponibilite->id)
                            selected
                        @endif        
                    >{{ $disponibilite->name }}</option>
                @endforeach
            </select>
            @error('disponibilite')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </form>
</div>

          
        </div>
        <div class="col-lg-3">
            
        </div>
    </div>
</div>

@endsection