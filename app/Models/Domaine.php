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

    protected $with = ["childrens"];

    public function childrens(){
        return $this->hasMany(Theme::class,'domaine_id','id');
    }
}
