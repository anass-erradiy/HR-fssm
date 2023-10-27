<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourFirier extends Model
{
    use HasFactory;
    protected $fillable=[
        'reference',
        'date_D',
        'date_F',
    ] ;
}
