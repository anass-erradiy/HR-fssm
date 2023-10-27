<?php

namespace App\Http\Controllers;
use App\Models\User ;
use App\Mail\MailResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
// use Psy\Util\Str ;
// use Dotenv\Util\Str ;
use Illuminate\Support\Str ;

class ResetPassword extends Controller
{
    public function __construct()
    {
        $this->middleware('roleCheck') ;
    }

    public function resetUserPass($id){
        $password = Str::random(8) ;
        $user = User::find($id) ;
        $name = $user->prenom .' '.$user->nom ;
        $user->update(['password' => Hash::make($password)]) ;
        Mail::to($user->email)->send(new MailResetPassword($name , $password));
        return redirect()->route('showUsers')->with('message','Le mot de passe de '.strtoupper($name).' réinitialisé avec succès');
    }
}
