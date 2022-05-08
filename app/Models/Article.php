<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article',
        'description',
        'image_alt',
        'image_path',
        'id_marque',
        'id_categorie_utilisation',
    ];

    public function marque()
    {
        return $this->belongsTo(Marque::class,'id_marque','id');
    }

    public function category()
    {
        return $this->belongsTo(CategorieUtilisation::class,'id_categorie_utilisation','id');
    }
}
