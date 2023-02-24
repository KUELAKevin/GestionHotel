@extends('layouts.admin')
  
@section('content')

    @if (Auth::check() && Auth::user()->id==$reservation->user_id)
        <div class="jumbotron">
        <h3 class="display-6 text-center">Vos réservations sur Gestion Hotel</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="articles row justify-content-center">
            @foreach ($reservations as $reservation )
                <div class="col-md-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('reservations.show',['reservation'=>$reservation->id])}}">{{ $reservation->chambre->numero_porte }}</a></h5>
                            {{-- <p class="time">{{  $chambre->created_at->diffForHumans()}}</p> --}}
                            <hr>
                            <h5><a href="{{ route('user.profile',['user'=>$reservation->user->id]) }}">{{ $reservation->user->name }}</a> Reservée le 
                            {{ $reservation->created_at->format('d/m/y') }}
                            </h5>
                            <hr>

                            <p>{{ $reservation->chambre->category->name }} </p>
                            
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
            @endforeach
        </div>
        <div class="pagination mt-4">
            {{$reservations->links()}}
        </div>
    @else
        <h1>Connecter vous pour voir vos réservations</h1>

    @endif 
       
   
@endsection