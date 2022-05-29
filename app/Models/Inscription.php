<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cycle_formation',
        'id_user',
        'etat'
        ];

    protected $with = ['clients'];

    public function clients (){
        return $this->belongsTo(User::class,'id_user','id');
    }
}
