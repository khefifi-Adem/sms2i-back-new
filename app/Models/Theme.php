<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'domaine_id'
    ];

    protected $with = ['childrens'];

    public function childrens(){
        return $this->hasMany(Niveau::class,'theme_id','id');
    }

    public function domaine()
    {
        return $this->belongsTo(Domaine::class,'domaine_id','id');
    }
}
