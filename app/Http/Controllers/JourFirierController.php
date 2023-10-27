<?php

namespace App\Http\Controllers;

use App\Models\JourFirier;
use App\Models\User;
use App\Notifications\DemandeNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class JourFirierController extends Controller
{
//     AjouterJourFerier
// storeJourFerier
// editJourFerier
// deleteJourFerier
    public function AjouterJourFerier(){
        return view('jourFerier.AjouterJourFerier') ;
    }
    public function storeJourFerier(Request $request){
        $request->validate([
            'reference' => 'required|max:50' ,
            'date_D' => 'required' ,
            'date_F' => 'required|after:date_D',
        ]);
        $jourfirier =JourFirier::create([
            'reference' => $request->reference ,
            'date_D' => $request->date_D ,
            'date_F' => $request->date_F ,
        ]) ;
        $user = User::where('id','!=',Auth::user()->id)->get();
        $routeName = 'VoirJourFerierNotif' ;
        $user_name = "FSSM-HR";
        $imagePath= 'images/logo/holiday.png' ;
        $body = 'Un jour fériér a été  ajouté ';
        Notification::send($user,new DemandeNotif($jourfirier->id,$user_name,$imagePath,$body,$routeName)) ;
        return redirect()->route('VoirJourFerier') ;
    }
    public function editJourFerier(Request $request,$id){
        $request->validate([
            'reference' => 'required|max:50' ,
            'date_D' => 'required' ,
            'date_F' => 'required|after:date_D',
        ]);
        $jourfirier =JourFirier::where('id',$id)->create([
            'reference' => $request->reference ,
            'date_D' => $request->date_D ,
            'date_F' => $request->date_F ,
        ]) ;
        $user = User::where('id','!=',Auth::user()->id)->get();
        DB::table('notifications')->where('data->demandeId',$id)->delete() ;
        $routeName = 'VoirJourFerierNotif' ;
        $user_name = "FSSM-HR";
        $imagePath= 'images/logo/holiday.png' ;
        $body = 'Un jour fériér a été  ajouté ';
        Notification::send($user,new DemandeNotif($jourfirier->id,$user_name,$imagePath,$body,$routeName)) ;
        return redirect()->back();
    }
    public function VoirJourFerierNotif($id){
        DB::table('notifications')->where('id',$id)->delete()  ;
        return redirect()->route('VoirJourFerier') ;
    }
    public function deleteJourFerier($id){
        JourFirier::where('id',$id)->delete() ;
        DB::table('notifications')->where('data->demandeId',$id)->delete() ;
        return redirect()->back() ;
    }
    public function VoirJourFerier(){
        $data = JourFirier::all();
        return view('jourFerier.VoirJourFerier',compact('data')) ;
    }

}
