<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'secteur_id'
    ];

    public function theme(){
        return $this->hasMany(Theme::class,'domaine_id','id');
    }

    public function domaine()
    {
        return $this->belongsTo(Secteur::class,'secteur_id','id');
    }
}
