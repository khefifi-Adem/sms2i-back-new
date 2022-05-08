<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'theme_id'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class,'theme_id','id');
    }
}
