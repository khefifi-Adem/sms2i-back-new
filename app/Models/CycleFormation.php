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
        'niveau_id',
        'cout',
        'etat'

    ];


}
