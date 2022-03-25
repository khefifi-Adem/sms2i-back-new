<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardAcceuil extends Model
{
    use HasFactory;
    protected $fillable = [
        'card_head',
        'card_icon',
        'card_text'
        ];
}
