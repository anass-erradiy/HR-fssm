<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification ;
use App\Notifications\DemandeNotif ;
use Illuminate\Support\Facades\DB ;

class FormationController extends Controller
{
    public function AjouterFormation(){
        return view('formation.AjouterForamtion') ;
    }
    public function storeFormation(Request $request){
        $request->validate([
            'cadreFormation' => 'required|max:50' ,
            'lieu' => 'required|max:100' ,
            'date_D' => 'required' ,
            'date_F' => 'required|after:date_D',
        ]);
        $foramtion =Formation::create([
            'cadreFormation' => $request->cadreFormation ,
            'lieu' => $request->lieu ,
            'date_D' => $request->date_D ,
            'date_F' => $request->date_F ,
        ]) ;
        $user = User::where('id','!=',Auth::user()->id)->get();
        $routeName = 'VoirFormationNotif' ;
        $user_name = "FSSM-HR";
        $imagePath= 'images/logo/formation.png' ;
        $body = 'Une formation a été ajouter ';
        Notification::send($user,new DemandeNotif($foramtion->id,$user_name,$imagePath,$body,$routeName)) ;
        return redirect()->route('VoirFormation') ;
    }
    public function editFormation(Request $request ,$id){
        $request->validate([
            'cadreFormation' => 'required|max:50' ,
            'lieu' => 'required|max:100' ,
            'date_D' => 'required' ,
            'date_F' => 'required|after:date_D',
        ]);
        Formation::where('id',$id)->update([
            'cadreFormation' => $request->cadreFormation ,
            'lieu' => $request->lieu ,
            'date_D' => $request->date_D ,
            'date_F' => $request->date_F ,
        ]) ;
        $user = User::where('id','!=',Auth::user()->id)->get();
        $foramtion = Formation::find($id) ;
        DB::table('notifications')->where('data->demandeId',$id)->delete() ;
        $routeName = 'VoirFormationNotif' ;
        $user_name = "FSSM-HR";
        $imagePath= 'images/logo/formation.png' ;
        $body = 'Une formation a été ajouter ';
        Notification::send($user,new DemandeNotif($foramtion->id,$user_name,$imagePath,$body,$routeName)) ;
        return redirect()->back() ;

    }
    public function VoirFormationNotif($id){
        DB::table('notifications')->where('id',$id)->delete()  ;
        return redirect()->route('VoirFormation') ;
    }
    public function VoirFormation(){
        $data = Formation::all();
        return view('formation.VoirFormation',compact('data')) ;
    }
    public function deleteFormation($id){
        Formation::where('id',$id)->delete() ;
        DB::table('notifications')->where('data->demandeId',$id)->delete() ;
        return redirect()->back() ;
    }
}
