<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth ;
use App\Models\Demmande;
use App\Models\File;
use App\Models\User;
use App\Notifications\DemandeNotif;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Notification ;
use Illuminate\Support\Facades\Storage ;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use Symfony\Component\HttpFoundation\Response ;
use Illuminate\Support\Facades\DB ;

class DemmandeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth') ;
    }

    //Demmande de conge

    public function créeDemmandeCong() {
        return view('demmandes.créeDemmandeCong') ;
    }
    public function demmandeCong() {
        $data = User::find(Auth::user()->id)->demmandes()->where('type',0)->get() ;
        return view('demmandes.demmandesCong',compact('data')) ;
    }
    public function downloadJustification($id){
        $path = Demmande::with('file')->find($id)->file->first()->path;
        return Storage::disk('local')->download($path);
    }

    public function ajouteDemmandeCong(Request $request) {
        $request->validate([
            'titre' => 'required|max:40',
            'date_D' => 'required' ,
            'date_F' => 'required|after:date_D' ,
            'description' => 'required' ,
            'filePath' => 'required|mimes:pdf|max:2048'
        ]) ;
        // $fileName = $request->filePath->getClientOriginalName();
        // $filePath = 'uploads/'.$fileName;
        // $path = Storage::disk('local')->put($filePath, file_get_contents($request->filePath));
        $path = $request->file('filePath')->store('uploads') ;
        // return Auth::user()->id ;
        $demmande = Demmande::create([
            'titre' => $request->titre ,
            'description' => $request->description,
            'type' => $request->type ,
            'date_D' => $request->date_D ,
            'date_F' => $request->date_F ,
            'user_id' => Auth::user()->id,

        ]) ;
        $demmande->file()->create([
            'path' => $path ,
            'type'=> 'PDF'
        ]) ;
        $users = User::where('admin' , 1)->where('id','!=',Auth::user()->id)->get() ;
        $user_name = Auth::user()->prenom ." ". Auth::user()->nom ;
        $imagePath=  Auth::user()->image->first()->path ;
        $body = 'ajoutée une demande de congé' ;
        $routeName = 'demmandeCheckCongNotif';
        // return $users ;
        Notification::send($users,new DemandeNotif($demmande->id,$user_name,$imagePath,$body,$routeName)) ;
        return redirect()->route('demmandeCong')  ;
    }

    //Demmande de travail
    public function créeDemmandeSal() {
        return view('demmandes.créeDemmandeSalaire') ;
    }
    public function demmandeSal() {
        $data = User::find(Auth::user()->id)->demmandes()->where('type',1)->get() ;
        return view('demmandes.demmandesSalaire',compact('data')) ;
    }


    //Demmande de travail
    public function créeDemmandeTrav() {

        return view('demmandes.créeDemmandeTravail') ;
    }
    public function demmandeTrav() {
        $data = User::find(Auth::user()->id)->demmandes()->where('type',2)->get() ;
        return view('demmandes.demmandesTravail',compact('data')) ;
    }

    public function ajouteDemmande(Request $request) {
        $request->validate([
            'titre' => 'required|max:40',
            'date_D' => 'required' ,
            'date_F' => 'required|after:date_D' ,
            'description' => 'required' ,
        ]) ;
        $demmande= Demmande::create([
            'titre' => $request->titre ,
            'description' => $request->description,
            'type' => $request->type ,
            'date_D' => $request->date_D ,
            'date_F' => $request->date_F ,
            'user_id' => Auth::user()->id

        ]) ;
         if ($request->type == 1) {
            $users = User::where('admin' , 1)->where('id','!=',Auth::user()->id)->get() ;
            $user_name = Auth::user()->prenom ." ". Auth::user()->nom ;
            $imagePath=  Auth::user()->image->first()->path ;
            $body = 'ajoutée une demande attestation de salaire ' ;
            $routeName = 'demmandeCheckSalNotif';
            Notification::send($users,new DemandeNotif($demmande->id,$user_name,$imagePath,$body,$routeName)) ;
            return redirect()->route('demmandeSal') ;
        }else{
            $users = User::where('admin' , 1)->where('id','!=',Auth::user()->id)->get() ;
            $user_name = Auth::user()->prenom ." ". Auth::user()->nom ;
            $imagePath=  Auth::user()->image->first()->path ;
            $body = 'ajoutée une demande attestation de travail' ;
            $routeName = 'demmandeCheckTravNotif';
            Notification::send($users,new DemandeNotif($demmande->id,$user_name,$imagePath,$body,$routeName)) ;
            return redirect()->route('demmandeTrav') ;
        }
    }

    public function aupdateDemmande(Request $request,$id){
        if ($request->hasFile('filePath')) {
            $request->validate([
            'titre' => 'required|max:40',
            'date_D' => 'required' ,
            'date_F' => 'required|after:date_D' ,
            'filePath' => 'mimes:pdf'
            ]) ;
            Demmande::find($id)->update([
                'titre' => $request->titre ,
                'description' => $request->description ,
                'date_D' => $request->date_D ,
                'date_F' => $request->date_F
            ]) ;
            $path = Demmande::with('file')->find($id)->file->first()->path;
            Storage::disk('local')->delete($path) ;
            $demmande = Demmande::find($id) ;
            $filePath = $request->file('filePath')->store('uploads') ;
            $demmande->file()->update([
                'path' => $filePath
            ]) ;
            return redirect()->route('demmandeCong') ;
        }

        $demmande = Demmande::find($id)->update([
            'titre' => $request->titre ,
            'description' => $request->description ,
            'date_D' => $request->date_D ,
            'date_F' => $request->date_F
        ]) ;
         if ($request->type == 1) {
            return redirect()->route('demmandeSal') ;
        }else{
            return redirect()->route('demmandeTrav') ;
        }
    }
    public function demmandeCongNotif($id){
        DB::table('notifications')->where('id',$id)->delete() ;
        return redirect()->route('demmandeCong') ;
    }
    public function demmandeSalNotif($id){
        DB::table('notifications')->where('id',$id)->delete() ;
        return redirect()->route('demmandeSal') ;
    }
    public function demmandeTravNotif($id){
        DB::table('notifications')->where('id',$id)->delete() ;
        return redirect()->route('demmandeTrav') ;
    }
}
