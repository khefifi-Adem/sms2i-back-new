<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card_etape extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'icon',
        'description',
    ];
}
