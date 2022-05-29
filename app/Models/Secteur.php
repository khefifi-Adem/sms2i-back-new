<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description'
    ];
    protected $with = ["childrens"];

    public function childrens(){
        return $this->hasMany(Domaine::class,'secteur_id','id');
    }

}
