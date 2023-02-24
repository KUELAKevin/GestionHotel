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
            
            <div class="card-header">Modifier la reservation de la chambre  {{ $reservation->chambre->numero_porte }}</div>
<div class="card-body">
    <form action="{{ route('reservations.update',['reservation'=>$reservation->id]) }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="date_debut" class="form-label">Date de debut</label>
            <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut', $reservation->date_debut) }}" >
            @error('date_debut')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de fin</label>
            <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin', $reservation->date_fin) }}" >
            @error('date_fin')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="chambre">Chambre</label>
            <select name="chambre" class="form-control">
                <option value=""></option>
                {{-- @foreach ($chambres as $chambre ) --}}
                    @if (old('chamre',$chambre->id)==$chambre->id)
                        <option value="{{ $chambre->id }}" 
                            @if (old('chamre',$chambre->id ?? '')== $chambre->id)
                                selected
                            @endif     
                        >{{ $reservation->chambre->numero_porte }}</option>
                    @endif
                    
                {{-- @endforeach --}}
            </select>
            @error('chambre')
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