@extends('layouts.admin')
  
@section('content')

    <div class="jumbotron">
    <h3 class="display-6 text-center">Chambres {{ $category->name }}s</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="articles row justify-content-center">
        @forelse ($chambres as $chambre)
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('chambres.show',['chambre'=>$chambre->id])}}">{{ $chambre->numero_porte }}</a></h5>
                        {{-- <p class="time">{{  $chambre->created_at->diffForHumans()}}</p> --}}
                        <hr>
                        <h5><a href="{{ route('user.profile',['user'=>$chambre->user->id]) }}">{{ $chambre->user->name }}</a> inscrit le {{ $chambre->user->
                        created_at->format('d/m/y') }}
                        </h5>
                        <hr>
                        @if($chambre->category->name=='Ventilée')
                            <p>Prix= 6000F/jour</p>
                        @else
                            <p>Prix= 10000F/jour</p>
                        @endif
                        <hr>
                        <p>{{ $chambre->category->name }} </p>
                         <hr>
                        <p>{{ $chambre->disponibilite->name }}</p> 

                        @if (Auth::check() && Auth::user()->id==21)
                            <div class="author" mt-3>
                                <a href="{{ route('chambres.edit',['chambre'=>$chambre->id]) }}" class="btn btn-info">Modifier</a> &nbsp;
                        
                                <form style="display: inline;" action="{{ route('chambres.destroy',['chambre'=>$chambre->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div>
                Aucun
            </div>
        @endforelse
    </div>
    <div class="pagination mt-4">
        {{$chambres->links()}}
    </div>
    
   
@endsection