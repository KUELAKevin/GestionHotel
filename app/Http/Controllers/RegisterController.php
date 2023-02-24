<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function index() //formulaire d'inscription
    {
        $data=[
            'title' => 'Inscription- '.config('app.name'),
        ];
        return view('auth.register',$data);
    }
    public function register(Request $request) //traitement de formulaire d'inscription
    {
       request()->validate([
        'name'=>'required|min:2|max:25|unique:users',
        'prenom'=>'required|min:2|max:25|unique:users',
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'email'=>'required|email|unique:users',
        'password'=>'required|between:8,20',
       ]);
       $user = new User;
       //$user->name=$request->name;
       //$user->prenom=$request->prenom;
       //$user->phone=$request->phone;
       //$user->email=$request->email;
       //$user->password=bcrypt($request->password);
       $user->name=request('name');
       $user->prenom=request('prenom');
       $user->phone=request('phone');
       $user->email=request('email');
       $user->password=bcrypt(request('password'));
       $user->save();

       $success= 'Inscription terminée';
       return back()->withSuccess($success);
    }
}
