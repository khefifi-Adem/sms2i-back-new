<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeCycle extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'nb_personne',
        'id_client_indus',
        'id_niveau',
        'message'
    ];

    protected $with = ["client","niveau"];

    public function client(){
        return $this->belongsTo(User::class,'id_client_indus','id');
    }
    public function niveau(){
        return $this->belongsTo(Niveau::class,'id_niveau','id');
    }
}
