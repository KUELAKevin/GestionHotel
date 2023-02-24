<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;

class DisponibiliteController extends Controller
{
    public function show(Disponibilite $disponibilite) //les chambres en fonction de la disponibilité
    {
        $chambres= $disponibilite->chambres()->paginate(6);

        $data = [
            'title'=>$disponibilite->name,
            'category'=>$disponibilite,
            'chambres'=>$chambres,
        ];
        return view('disponibilite.show',$data);
    }

}
