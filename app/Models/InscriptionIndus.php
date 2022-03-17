<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscriptionIndus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cycle_formation',
        'id_user',
        'nb_personnel',
        'cout',
    ];
}
