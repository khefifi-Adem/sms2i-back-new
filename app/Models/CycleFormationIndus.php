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
        'nb_places_dispo',
        'id_user',
        'id_formateur',
        'niveau_id',
        'cout',
        'etat'
    ];
}
