<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleFormationIndus extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'nb_jours',
        'nb_heures',
        'nb_places',
        'id_user',
        'id_formateur',
        'niveau_id',
        'cout',
        'etat',
        'link'
    ];

    protected $with = ['fileDetails','fileProgramme','files','niveaux','user'];

    public function fileDetails (){
        return $this->hasMany(DetailsFile::class,'id_induses','id');
    }
    public function fileProgramme (){
        return $this->hasMany(ProgrammeFile::class,'id_induses','id');
    }
    public function files (){
        return $this->hasMany(Files::class,'id_induses','id');
    }
    public function niveaux (){
        return $this->belongsTo(Niveau::class,'niveau_id','id');
    }

    public function user (){
        return $this->belongsTo(User::class,'id_user','id');
    }


}
