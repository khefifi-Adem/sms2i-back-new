<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NosParteners extends Model
{
    use HasFactory;
    protected $fillable = [
        'partener',
        'partener_description',
        'image_alt',
        'image_path'
    ];
}
