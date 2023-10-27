<?php

namespace App\Http\Controllers;

use App\Models\Demmande;
use App\Models\Formation;
use App\Models\JourFirier;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $calculatePercentage =function($value, $total)
        {
            if ($total == 0) {
                return 0;
            }

            $percentage = $value / $total * 100;

            return number_format($percentage, 2);
        } ;


        $usersPerMonth = User::whereMonth('created_at',date('m'))->get() ;
        $users = User::orderBy('created_at','desc')->get() ;
        // return $users->image->first()->path ;


        // return $calculatePercentage(count($usersPerMonth),count($users)) ;
        $demande = Demmande::with('user')->orderBy('created_at','desc')->get() ;
        $lastMonthDemande = Demmande::whereMonth('created_at',date('m')-1)->get() ;
        $thisMonthDemande = Demmande::whereMonth('created_at',date('m'))->get() ;

        $formation = Formation::orderBy('created_at','desc')->get()  ;
        $lastMonthFormation = Formation::whereMonth('created_at',date('m')-1)->get() ;
        $thisMonthFormation = Formation::whereMonth('created_at',date('m'))->get() ;

        $jourFeries = JourFirier::orderBy('created_at','desc')->get() ;
        // return $jourFeries;

        return view('home')->with('data',[
            'users'=>$users,
            'demande'=>$demande,
            'formation'=>$formation,
            'usersPerMonth' => $usersPerMonth,
            'calculatePercentage' => $calculatePercentage,
            'lastMonthDemande' => $lastMonthDemande ,
            'thisMonthDemande' => $thisMonthDemande,
            'lastMonthFormation' => $lastMonthFormation ,
            'thisMonthFormation' => $thisMonthFormation,
            'jourFeries' => $jourFeries,
        ]);
    }
}
