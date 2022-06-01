<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleFormation extends Model
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
        'nb_places_dispo',
        'formateur_id',
        'niveau_id',
        'cout',
        'etat',
        'link',

    ];

    protected $with = ['fileDetails','fileProgramme','inscription','files','niveaux','formateur'];

    public function fileDetails (){
        return $this->hasOne(DetailsFile::class,'id_cycle','id');
    }
    public function inscription (){
        return $this->hasMany(Inscription::class,'id_cycle_formation','id');
    }
    public function fileProgramme (){
        return $this->hasOne(ProgrammeFile::class,'id_cycle','id');
    }
    public function files (){
        return $this->hasMany(Files::class,'id_cycle','id');
    }
    public function niveaux (){
        return $this->belongsTo(Niveau::class,'niveau_id','id');
    }
    public function formateur (){
        return $this->belongsTo(User::class,'formateur_id','id');
    }


}
