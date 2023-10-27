<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demmande extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'type',
        'date_D',
        'date_F',
        'filePath' ,
        'date_traitement' ,
        'titre_reponse' ,
        'justification' ,
        'status' ,
        'user_id'
    ];
    public function file(){
        return $this->morphMany(File::class,'documentable') ;
    }
    public function user(){
        return $this->belongsTo(User::class) ;
    }
}
