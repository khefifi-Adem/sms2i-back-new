<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'edition',
        'description',
        'image_path',
        'id_marque',
        'id_categorie_utilisation',
    ];

    protected $with = ["marque"];

    public function marque()
    {
        return $this->belongsTo(Marque::class,'id_marque','id');
    }

}
