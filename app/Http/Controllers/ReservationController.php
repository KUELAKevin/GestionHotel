<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Chambre,Category,Disponibilite,Reservation
};
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest; 

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }
    
    protected $perPage=6;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::orderByDesc('id')->paginate($this->perPage);
        $data=[
            'title'=>'Vos reservations sur '.config('app.name'),
            'reservations'=>$reservations,
        ];
        return view('reservation.index',$data);
        //foreach ($reservations as $reservation) {
           // dump($chambre->numero_porte);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chambres=Chambre::get();
        $data= [
            'title'=>'Reserver une nouvelle chambre',
            'chambres'=>$chambres,
        ];
        return view('reservation.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        $validatedData =  $request->validated();
        $validatedData['chambre_id']=request('chambre');


        // $nomuser=Auth::user()->id;
        // $
        

        Auth::user()->reservations()->create($validatedData );
        $success = 'Reservation effectuée';
        return back()->withSuccess($success);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        abort_if(auth()->id()!=$reservation->user_id, 403);
        $data = [
            'title'=>$reservation->chambre->numero_porte.'-'.config('app.name'),
            'reservation'=>$reservation,
        ];
        return view('reservation.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        abort_if(auth()->id()!=$reservation->user_id, 403);

        $data= [
            'title'=>'Mise à jour de la reservation de la '.$reservation->chambre->numero_porte,
            'reservation'=>$reservation,
            'chambre'=>Chambre::first(),
        ];
        return view('reservation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        abort_if(auth()->id()!=$reservation->user_id, 403);

        $validatedData =  $request->validated();
        $validatedData['chambre_id']=request('chambre',null);

        Auth::user()->reservations()->updateOrCreate(['id'=>$reservation->id],$validatedData);
        // if(Auth::attempt(['date_debut' =>request('date_debut'),'date_fin' => request('date_fin'),'chambre'=>request('chambre')])){
        //     return redirect('/');
        // }
        // return back()->withError('Mauvais identifiants.')->withInput();

        // $success = 'Reservation modifiée';
        return redirect('facture');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        abort_if(auth()->id()!=$reservation->user_id, 403);
        $reservation->delete();
        $success= 'Reservation annulée';
        return back()->withSuccess($success);

    }
}
