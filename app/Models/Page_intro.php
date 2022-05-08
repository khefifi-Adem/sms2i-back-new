<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page_intro extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'titre',
        'description',
        'image_path',
    ];
}
