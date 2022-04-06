<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieUtilisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie',
        'description',
        'image_alt',
        'image_path',
    ];

    public function article(){
        return $this->hasMany('articles');
    }


}