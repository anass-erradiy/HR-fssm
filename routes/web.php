<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth ;
use App\Http\Controllers\AdminController ;
use App\Http\Controllers\AdminDemmande;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\DemmandeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\JourFirierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\UserController;
use App\Models\Demmande;
use Faker\Guesser\Name;
use PHPUnit\Framework\Attributes\BackupGlobals;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes([
]) ;


Route::get('printPDF/{id}',[AdminDemmande::class,'printPDF'])->name('printPDF') ;

Route::controller(FormationController::class)->group( function(){
    Route::get('/AjouterFormation','AjouterFormation')->name('AjouterFormation')->middleware('roleCheck');
    Route::post('/storeFormation','storeFormation')->name('storeFormation')->middleware('roleCheck');
    Route::get('/VoirFormation','VoirFormation')->name('VoirFormation')->middleware('auth');
    Route::post('/editFormation{id}','editFormation')->name('editFormation')->middleware('roleCheck');
    Route::get('/VoirFormationNotif{id}','VoirFormationNotif')->name('VoirFormationNotif')->middleware('auth');
    Route::get('/deleteFormation{id}','deleteFormation')->name('deleteFormation')->middleware('roleCheck');
}
 ) ;
Route::controller(JourFirierController::class)->group( function(){
    Route::get('/AjouterJourFerier','AjouterJourFerier')->name('AjouterJourFerier')->middleware('roleCheck');
    Route::get('/VoirJourFerier','VoirJourFerier')->name('VoirJourFerier')->middleware('auth');
    Route::get('/VoirJourFerierNotif{id}','VoirJourFerierNotif')->name('VoirJourFerierNotif')->middleware('auth');
    Route::post('/storeJourFerier','storeJourFerier')->name('storeJourFerier')->middleware('roleCheck');
    Route::post('/editJourFerier{id}','editJourFerier')->name('editJourFerier')->middleware('roleCheck');
    Route::get('/deleteJourFerier{id}','deleteJourFerier')->name('deleteJourFerier')->middleware('roleCheck');
}
 ) ;
 Route::controller(ResetPassword::class)->group( function(){
    Route::get('/resetUserPass{id}','resetUserPass')->name('resetUserPass');
 }
 ) ;

Route::controller(AnnonceController::class)->group(function(){
    Route::get('AjouterAnnonce','AjouterAnnonce')->name('AjouterAnnonce')->middleware('roleCheck') ;
    Route::post('StoreAnnonce','StoreAnnonce')->name('StoreAnnonce')->middleware('roleCheck') ;
    Route::get('VoirAnnoce','VoirAnnoce')->name('VoirAnnoce')->middleware('auth') ;
    Route::get('VoirAnnoceNotif{id}','VoirAnnoceNotif')->name('VoirAnnoceNotif')->middleware('auth') ;
    Route::post('annonceEdit{id}','annonceEdit')->name('annonceEdit')->middleware('roleCheck') ;
    Route::get('annonceDelete{id}','annonceDelete')->name('annonceDelete')->middleware('roleCheck') ;
}) ;

Route::controller(UserController::class)->group(function(){
    Route::get('/utilisateurs','showUsers')->name('showUsers');
    Route::post('/editUser/{id}','editUser')->name('editUser');
    Route::get('/deleteUser/{id}','deleteUser')->name('deleteUser');
    Route::get('/deletedUsers','deletedUsers')->name('deletedUsers');
    Route::get('/restoreUser{id}','restoreUser')->name('restoreUser');
    Route::get('/forceDelete{id}','forceDelete')->name('forceDelete');
});

Route::controller(ProfileController::class)->group(function () {
    Route::post('/changePassword','changePassword')->name('changePassword') ;
    Route::get('/settings','settings')->name('settings') ;
    Route::get('/profile', 'showProfile')->name('showProfile');
    Route::post('/updateProfil', 'updateProfil')->name('updateProfil');
}) ;
Route::controller(DemmandeController::class)->group(function(){
    //demmande de congee
    Route::get('/créeDemmandeCong','créeDemmandeCong')->name('créeDemmandeCong');
    Route::get('/demmandeCong','demmandeCong')->name('demmandeCong');
    //Add new demmande => using one method 'AjouteDemmande'
    Route::post('/ajouteDemmande','ajouteDemmande')->name('ajouteDemmande');
    Route::post('/ajouteDemmandeCong','ajouteDemmandeCong')->name('ajouteDemmandeCong');
    //download justification
    Route::get('/downloadJustification/{id}','downloadJustification')->name('downloadJustification');

    //demmande de travail
    Route::get('/créeDemmandeTrav','créeDemmandeTrav')->name('créeDemmandeTrav');
    Route::get('/demmandeTrav','demmandeTrav')->name('demmandeTrav');
    //demmande de salaire
    Route::get('/créeDemmandeSal','créeDemmandeSal')->name('créeDemmandeSal');
    Route::get('/demmandeSal','demmandeSal')->name('demmandeSal');
    //Mise a jour demmande using 'upDemmande'
    Route::post('/aupdateDemmande/{id}','aupdateDemmande')->name('aupdateDemmande');
    //notification pour les reponses
    Route::get('/demmandeCongNotif{id}','demmandeCongNotif')->name('demmandeCongNotif') ;
    Route::get('/demmandeSalNotif{id}','demmandeSalNotif')->name('demmandeSalNotif') ;
    Route::get('/demmandeTravNotif{id}','demmandeTravNotif')->name('demmandeTravNotif') ;
});
Route::controller(AdminDemmande::class)->group(function(){
    //check demmandes conge
    Route::get('/demmandeCheckCong','demmandeCheckCong')->name('demmandeCheckCong') ;
    // check demmandes travail
    Route::get('/demmandeCheckTrav','demmandeCheckTrav')->name('demmandeCheckTrav') ;
    // check demmandes salaire
    Route::get('/demmandeCheckSal','demmandeCheckSal')->name('demmandeCheckSal') ;
    Route::post('/reponseDemmande{id}','reponseDemmande')->name('reponseDemmande') ;
    Route::get('/DeleteDemmande{id}','DeleteDemmande')->name('DeleteDemmande') ;
    Route::get('/demmandeCheckCongNotif{id}','demmandeCheckCongNotif')->name('demmandeCheckCongNotif') ;
    Route::get('/demmandeCheckSalNotif{id}','demmandeCheckSalNotif')->name('demmandeCheckSalNotif') ;
    Route::get('/demmandeCheckTravNotif{id}','demmandeCheckTravNotif')->name('demmandeCheckTravNotif') ;
    Route::get('/markAllAsRead','markAllAsRead')->name('markAllAsRead') ;
});
Route::get('/', [AdminController::class,'landing'])->name('landing');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/{page}', [AdminController::class,'index']);

