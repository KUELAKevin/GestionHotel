<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Chambre,Category,Disponibilite,Reservation
};
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChambreRequest; 

class ChambreController extends Controller
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
        $chambres = Chambre::orderByDesc('id')->paginate($this->perPage);
        $data=[
            'title'=>'Les chambres sur '.config('app.name'),
            'chambres'=>$chambres,
        ];
        return view('chambre.index',$data);
        //foreach ($chambres as $chambre) {
           // dump($chambre->numero_porte);
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();
        $disponibilites = Disponibilite::get();
        $data= [
            'title'=>'Ajouter une nouvelle chambre',
            'categories'=>$categories,
            'disponibilites'=>$disponibilites,
        ];
        return view('chambre.create',$data);
    }

    /**
     * Store a newl y created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChambreRequest $request)
    {
        $validatedData =  $request->validated();
        $validatedData['category_id']=request('category',null);
        $validatedData['disponibilite_id']=request('disponibilite',null);

        Auth::user()->chambres()->create($validatedData );
        // $chambre= Auth::user()->chambres()->create( request()->validate([
        //   'numero_porte'=>'required|min:2|max:25|unique:chambres',
        //    'category'=>'sometimes|nullable|exists:categories,id',
        //     'disponibilite'=> 'sometimes|nullable|exists:disponibilites,id',
        //     ])) ;

            //$chambre = Chambre::create([
            //    'user_id'=>auth()->id(),
            //    'numero_porte'=>request('numero_porte'),
            //    'category_id'=>request('category',null), 
            //   'disponibilite_id'=>request('disponibilite',null),
            //]);

        //$chambre = new Chambre;
        //$chambre->user_id = auth()->id();
        //$chambre->category_id = request('category',null);
        //$chambre->disponibilite_id = request('disponibilite', null);
        //$chambre->numero_porte = request('numero_porte');
        // $chambre->save();

        $success = 'Chambre ajoutée';
        return back()->withSuccess($success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chambre $chambre)
    {
        $data = [
            'title'=>$chambre->numero_porte.'-'.config('app.name'),
            'chambre'=>$chambre,
        ];
        return view('chambre.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Chambre $chambre)
    {
        abort_if(auth()->id()!=21, 403);

        $data= [
            'title'=>'Mise à jour'.$chambre->numero_porte,
            'chambre'=>$chambre,
            'categories'=>Category::get(),
            'disponibilites'=>Disponibilite::get(),
        ];
        return view('chambre.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChambreRequest $request, Chambre $chambre)
    {
        abort_if(auth()->id()!=21, 403);

        $validatedData =  $request->validated();
        $validatedData['category_id']=request('category',null);
        $validatedData['disponibilite_id']=request('disponibilite',null);

        Auth::user()->chambres()->updateOrCreate(['id'=>$chambre->id],$validatedData);

        $success = 'Chambre modifiée';
        return back()->withSuccess($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chambre $chambre)
    {
        abort_if(auth()->id()!=21, 403);
        // abort_if(auth()->id()!=$chambre->user_id, 403);
        $chambre->delete();
        $success= 'Chambre supprimée';
        return back()->withSuccess($success);

    }
}
