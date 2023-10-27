<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $fillable =[
        'titre_annonce' ,
        'body',
        'user_id' ,
        'usersCount',
        'userName'
    ] ;
    public function image(){
        return $this->morphMany(Image::class,'imageable') ;
    }
}
