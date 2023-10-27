<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use function PHPSTORM_META\map;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;
    use SoftDeletes ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guarded = [] ;
    protected $fillable = [
        'nom',
        'prenom',
        'som',
        'cin',
        'grade' ,
        'birthday',
        'email',
        'number',
        'sex' ,
        'pays' ,
        'region' ,
        'postalCode' ,
        'adress' ,
        'admin' ,
        'departement' ,
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function demmandes() {
        return $this->hasMany(Demmande::class,'user_id') ;
    }

    public function image(){
        return $this->morphMany(Image::class,'imageable') ;
    }
}
