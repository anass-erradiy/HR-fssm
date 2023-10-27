<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str ;
use Illuminate\Support\Facades\Notification ;
use App\Notifications\DemandeNotif ;
use Illuminate\Support\Facades\DB;

class AnnonceController extends Controller
{
    //
    public function AjouterAnnonce(){
        return view('Annonces.CreeAnnonce') ;
    }
    public function StoreAnnonce(Request $request){
        Str::limit($request->body, 20, '...') ;

        $request->validate([
            'titre_annonce' => 'required|max:40',
            'body' => 'required'
        ]) ;
        $name = Auth::user()->nom.' '. Auth::user()->prenom ;
        $user = User::where('id','!=',Auth::user()->id)->get();
        $annonce = Annonce::create([
            'titre_annonce' => $request->titre_annonce,
            'user_id' => Auth::user()->id ,
            'body' => $request->body,
            'usersCount' => count($user),
            'userName' => $name
        ]) ;
        $annonce->image()->create([
            'path' => Auth::user()->image->first()->path ,
            'type' => 'annonce'
        ]);
        $routeName = 'VoirAnnoceNotif' ;
        $user_name = $request->titre_annonce;
        $imagePath= 'images/logo/annonce.png' ;
        $body = Str::limit($request->body, 20, '...');
        Notification::send($user,new DemandeNotif($annonce->id,$user_name,$imagePath,$body,$routeName)) ;
        return redirect()->route('VoirAnnoce') ;
    }
    public function VoirAnnoceNotif($id){
        DB::table('notifications')->where('id',$id)->delete() ;
        return redirect()->route('VoirAnnoce') ;
    }
    public function VoirAnnoce(){
        $data = Annonce::with('image')->get() ;
        // return $data ;
        return view('Annonces.VoirAnnonce',compact('data')) ;
    }
    public function annonceEdit(Request $request, $id){
        $request->validate([
            'titre_annonce' => 'required|max:20' ,
            'body' => 'required'
        ]) ;
        Annonce::where('id',$id)->update([
            'titre_annonce'=> $request->titre_annonce ,
            'body' => $request->body
        ]) ;
        DB::table('notifications')->where('data->demandeId',$id)->delete() ;
        $user = User::where('id','!=',Auth::user()->id)->get();
        $routeName = 'VoirAnnoceNotif' ;
        $user_name = $request->titre_annonce;
        $imagePath= 'images/logo/annonce.png' ;
        $body = Str::limit($request->body, 20, '...');
        Notification::send($user,new DemandeNotif($id,$user_name,$imagePath,$body,$routeName)) ;
        return redirect()->route('VoirAnnoce') ;
    }
    public function annonceDelete($id){
        Annonce::where('id',$id)->delete() ;
        DB::table('notifications')->where('data->demandeId',$id)->delete() ;
        return redirect()->back() ;
    }
}
