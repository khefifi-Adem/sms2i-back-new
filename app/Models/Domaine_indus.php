<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine_indus extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description'
    ];


    public function projects(){
        return $this->hasMany(Project::class,'id_domaine_indus','id');
    }
}
