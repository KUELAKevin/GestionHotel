<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ResetController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function index(string $token) //formulaire de réinitialisation de mot de pase
    {
        $password_reset = DB::table('password_resets')->where('token',$token)->first();
        abort_if(!$password_reset,403);
        $data=[
            'title'=>'Réinitialisation de mot de passe-'.config('app.name'),
            'password_reset'=>$password_reset,
        ];
        return view('auth.reset',$data);
    }

    public function reset() //traitement de réinitialisation de mot de passe
    {
        request()->validate([
            'email'=>'required|email',
            'token'=>'required',
            'password'=>'required|between:8,20|confirmed',
        ]);
        if(! DB::table('password_resets')
            ->where('email',request('email'))
            ->where('token',request('token'))->count()
            ){
            $error = 'Vérifiez l\'adresse email';
            return back()->withError($error)->withInput();
        }
        $user= User::whereEmail(request('email'))->firstOrFail();
        $user->password = bcrypt(request('password'));
        $user->save();
        DB::table('password_resets')->where('email',request('email'))->delete();

        $success= 'Mot de passe mis à jour';
        return redirect()->route('login')->withSuccess($success);
    }
}
