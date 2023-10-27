<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification ;
use App\Models\Demmande;
use App\Models\DemmandeS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use App\Notifications\DemandeNotif;
// use Barryvdh\DomPDF\PDF ;
// use PhpOffice\PhpSpreadsheet\Writer\Pdf ;
use Barryvdh\DomPDF\Facade\Pdf ;
use Illuminate\Support\Facades\Auth;

class AdminDemmande extends Controller
{
    public function __construct()
    {
        $this->middleware('checkDemande') ;
    }
    // Conge
    public function demmandeCheckCong(){
        $data = User::with(['demmandes'=> function($d){
            $d->where('type',0) ;
        }])->get() ;
        return view('demmandes.demmandeCheckCong',compact('data')) ;
    }
    // travail
    public function demmandeCheckTrav(){
        $data = User::with(['demmandes'=> function($d){
            $d->where('type',2) ;
        }])->get() ;
        return view('demmandes.demmandeCheckTravail',compact('data')) ;
    }
    // Salaire
    public function demmandeCheckSal(){
        $data = User::with(['demmandes'=> function($d){
            $d->where('type',1) ;
        }])->get() ;
        return view('demmandes.demmandeCheckSalaire',compact('data')) ;
    }

    public function reponseDemmande(Request $request,$id){
        $demande= Demmande::find($id) ;
        $demande->update([
            'titre_reponse' => $request->titre_reponse ,
            'justification' => $request->justification,
            'status' => $request->status,
            'date_traitement' =>  now()->format('Y-m-d')
        ]
        ) ;
        // when the user update add a response or update the app will send a notification to the request owner
        if ($request->type == 0) {
            $type_demande = 'de congé' ;
            $routeName = 'demmandeCongNotif';
        }elseif ($request->type == 1) {
            $type_demande = 'attestation de salaire' ;
            $routeName = 'demmandeSalNotif';

        }else {
            $type_demande = 'attestation de travail' ;
            $routeName = 'demmandeTravNotif';

        }
        $user = User::find($demande->user_id);
        $user_name = 'FSSM-HR';
        $imagePath= 'images/logo/logo.png' ;
        $body = 'Vous avez une reponse sur votre demande '.$type_demande ;
        Notification::send($user,new DemandeNotif($demande->id,$user_name,$imagePath,$body,$routeName)) ;
        return redirect()->route('demmandeCheckCong') ;
    }
    public function DeleteDemmande($id){
        Demmande::where('id',$id)->delete() ;
        return redirect()->back() ;
    }
    public function printPDF($id){
        //get the demande info
        $Uid = Demmande::find($id) ;
        //get the user with the demande
        $data = User::with(['demmandes'=> function($d) use ($id) {
            $d->find($id)->where('type',0) ;
        }])->find($Uid->user_id) ;
        if ($data->demmandes->first()->status == 1) {
            $demmande = $data->demmandes->first() ;
            // return $demmande ;
            $pdf = app('dompdf.wrapper') ;
            $pdf->loadView('pdf_view',compact('data','demmande')) ;
            return $pdf->stream($data->prenom.'_Demande_de_conge.pdf') ;
        }
        return redirect()->back() ;
        // $pdf = Pdf::loadView('pdf_view');
        // $pdf = DomPDFPDF::loadView('pdf_view') ;
        // return $pdf->download('attestation_de_conge.pdf') ;
    }
    public function demmandeCheckCongNotif($id){
        DB::table('notifications')->where('id',$id)->delete() ;
        return redirect()->route('demmandeCheckCong') ;
    }
    public function demmandeCheckSalNotif($id){
        DB::table('notifications')->where('id',$id)->delete() ;
        return redirect()->route('demmandeCheckSal') ;
    }
    public function demmandeCheckTravNotif($id){
        DB::table('notifications')->where('id',$id)->delete() ;
        return redirect()->route('demmandeCheckTrav') ;
    }
    public function markAllAsRead(){
        DB::table('notifications')->where('notifiable_id',auth()->user()->id)->delete() ;
        return redirect()->back() ;
    }
}
