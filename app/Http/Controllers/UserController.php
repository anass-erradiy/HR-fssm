<?php

namespace App\Http\Controllers;

use App\Mail\MailResetPassword;
use Illuminate\Http\Request;
use App\Models\User ;

use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleCheck') ;
    }

    public function showUsers(){
        $users = User::with('image')->get() ;
        return view('utilisateurs',compact('users')) ;
    }
    public function editUser(Request $request,$id){
             $request->validate([
            'som' => ['required',Rule::unique('users')->ignore($id)],
            'cin' => ['required',Rule::unique('users')->ignore($id)],
            'prenom' => 'max:30|string' ,
            'nom'=> 'max:30|string' ,
            'email' => ['email',Rule::unique('users')->ignore($id), ],
        ]) ;
        // return $request ;
        User::find($id)->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'som' => $request->som,
            'cin'=> $request->cin,
            'birthday'=> $request->birthday,
            'email'=> $request->email,
            'number'=> $request->number,
            'postalCode' => $request->postalCode,
            'adress' => $request->adress,
            'admin' => $request->admin,
            'departement' => $request->departement,
        ]) ;
        $prenom = strtoupper($request->prenom) ;
        return redirect()->route('showUsers')->with(['message'=>"Les informations d'utilisateur $prenom modifiées avec succès"]) ;
    }
    public function deleteUser($id){
        User::find($id)->delete() ;
        return redirect()->back() ;
    }
    public function deletedUsers(){
        $users = User::onlyTrashed()->get();
        return view('deletedUsers',compact('users')) ;
    }
    public function restoreUser($id){
        User::onlyTrashed()->where('id',$id)->restore();
        return redirect()->back() ;
    }
    public function forceDelete($id){
        User::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect()->back() ;
    }

}
