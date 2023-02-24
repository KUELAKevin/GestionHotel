<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Notifications\PasswordResetNotification;
use App\Models\User;

class ForgotController extends Controller
{   
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function index() //formulaire d'oublie de mot de passe
    {
        $data=[
            'title'=>'Oublie de mot de passe-'.config('app.name'),
        ];
        return view('auth.forgot',$data);
    }
    public function store() //verification des data et envoie de lien par mail
    {
        request()->validate([
            'email'=>'required|email|exists:users',
        ]);
        $token = Str::uuid();
        DB::table('password_resets')->insert([
            'email'=>request('email'),
            'token'=>$token,
            'created_at'=>now(),
        ]);
        //envoie de notification avec un lien securisé
        $user= User::whereEmail(request('email'))->firstOrFail();
        $user->notify(new PasswordResetNotification($token));
        $success = 'vérifier votre boite mail et suivez les instructions';
        return back()->withSuccess($success);
    }
}
