<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cycle',
        'id_induses',
        'file_path',
    ];
}
