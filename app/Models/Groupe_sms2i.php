<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe_sms2i extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_soc',
        'description',
        'image_path'
    ];
}
