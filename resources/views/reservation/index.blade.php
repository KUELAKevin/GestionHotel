@extends('layouts.admin')
  
@section('content')

    
        <div class="jumbotron">
        <h3 class="display-6 text-center">Vos réservations sur Gestion Hotel</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="articles row justify-content-center">
            @foreach ($reservations as $reservation )
            @if (Auth::check() && Auth::user()->id==$reservation->user_id)
                <div class="col-md-6">
                    <div class="card my-3">
                        <div class="card-body shadow">
                            <h5 class="card-title"><a href="{{route('reservations.show',['reservation'=>$reservation->id])}}">{{ $reservation->chambre->numero_porte }}</a></h5>
                            {{-- <p class="time">{{  $chambre->created_at->diffForHumans()}}</p> --}}
                            <hr>
                            <h5><a href="{{ route('user.profile',['user'=>$reservation->user->id]) }}">{{ $reservation->user->name }}</a> Reservée le 
                            {{ $reservation->created_at->format('d/m/y') }}
                            </h5>
                            <hr>
                            @if($reservation->chambre->category->name=='Ventilée')
                                <p>Prix= 6000Fcfa/jour</p>
                                <hr>
                                <p>Montant:{{ (((strtotime($reservation->date_fin)-strtotime($reservation->date_debut))/86400)*6000) }}Fcfa</p>
                            @else
                                <p>Prix= 10000Fcfa/jour</p>
                                <hr>
                                <p>Montant:{{ (((strtotime($reservation->date_fin)-strtotime($reservation->date_debut))/86400)*10000) }}Fcfa</p>
                            @endif
                            <hr>
                            <p>{{ $reservation->chambre->category->name }} </p>
                            <hr>
                            <p>Début le: {{ $reservation->date_debut}} </p>
                            <hr>
                            <p>Départ le: {{ $reservation->date_fin }} </p>
                            <div class="author" mt-3>
                                <a href="{{ route('reservations.edit',['reservation'=>$reservation->id]) }}" class="btn btn-info">Modifier</a> &nbsp;
                        
                                <form style="display: inline;" action="{{ route('reservations.destroy',['reservation'=>$reservation->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Annuler</button>
                                </form>
                            </div>
    
                        </div>
                    </div>
                </div>
            @endif 
            @endforeach
        </div>
        <div class="pagination mt-4">
            {{$reservations->links()}}
        </div>
       
   
@endsection