<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\File ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Validation\Rule;

$alert = null ;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth') ;
    }
    public function showProfile(){
        // return auth()->user()->image->first()->path ;
        return view('profile') ;
    }
    public function updateProfil(Request $request){
        if ($request->hasFile('image')) {
            $request->validate([
                'number' => ['max:20'],
                'region' => 'max:50',
                'postalCode' => 'max:6',
                'image' => 'mimes:png,jpg,gif,jpeg'
            ]) ;
            if(!isset(auth()->user()->image->first()->path)){
                $user= User::find(Auth::user()->id) ;
                $user->update(
                    $request->all()
                ) ;
                $file = $request->file('image') ;
                $fileName = uniqid().'_'.$file->getClientOriginalName() ;
                $destinationPath = public_path().'/images' ;
                $file->move($destinationPath,$fileName);
                $user->image()->create([
                    'path' => 'images/'.$fileName ,
                    'type' => 'profile'
                ]) ;
                return redirect()->route('showProfile') ;
            }else{
                $user= User::find(Auth::user()->id) ;
                $user->update(
                    $request->all()
                ) ;
                //save the image into the images folder
                $file = $request->file('image') ;
                $fileName = uniqid().'_'.$file->getClientOriginalName() ;
                $destinationPath = public_path().'/images' ;
                $file->move($destinationPath,$fileName);
                // delete the old image and update the old path from the image table
                $path = $user->image->first()->path ;
                if($path == 'images/avatar-02.png'){
                    $user->image()->update([
                        'path' => 'images/'.$fileName
                    ]) ;
                    $annonce = Annonce::where('user_id',Auth::user()->id)->first() ;
                    if((isset($annonce->id))){
                        return 'it works' ;
                        Image::where('imageable_id',$annonce->id)->update([
                            'path' => 'images/'.$fileName
                        ]) ;
                    }
                    return redirect()->route('showProfile') ;
                    // ->with('message','Les informations a ete modifier avec succes !');
                }else{
                    File::delete(public_path($path)) ;
                    $user->image()->update([
                        'path' => 'images/'.$fileName
                    ]) ;
                    $annonce = Annonce::where('user_id',Auth::user()->id)->first() ;
                    if((isset($annonce->id))){
                        Image::where('imageable_id',$annonce->id)->update([
                            'path' => 'images/'.$fileName
                        ]) ;
                    }
                    return redirect()->route('showProfile') ;
                }
                // ->with('message','Les informations a ete modifier avec succes !');
            }

        }else {
            $request->validate([
                'number' => ['max:20'] ,
                'region' => 'max:50',
                'postalCode' => 'max:6',
            ]) ;
            $info= User::find(Auth::user()->id) ;
            $info->update(
                $request->all()
            ) ;
            return redirect()->route('showProfile') ;
        }
    }
    public function settings(){
        $alert = false ;
        return view('settings')->with(['alert'=>$alert]) ;
        // $pass = Auth::user()->password ;
        // if(Hash::check('132654azli',$pass)){
        //     return 'it match' ;
        // }else {
        //     return 'it doesnt' ;
        // }
    }
    public function changePassword(Request $request){
        $user = Auth::user() ;
        $request->validate([
            'oldPassword' => ['required', 'string', 'min:8',
            function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The password does not match.');
                }
            }],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::find($user->id)->update([
            'password' => Hash::make($request->password)
        ]) ;
        $alert = true ;
        return redirect()->route('settings')->with(['alert'=>$alert]) ;
    }
}
