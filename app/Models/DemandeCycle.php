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
        'id_niveau'
    ];
}
