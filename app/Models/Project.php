<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'id_soc',
        'id_client_indus',
        'id_domaine_indus'
    ];

    protected $with = ["user","societe","domaine"];

    public function user()
    {
        return $this->belongsTo(User::class,'id_client_indus','id');
    }

    public function societe()
    {
        return $this->belongsTo(Groupe_sms2i::class,'id_soc','id');
    }

    public function domaine()
    {
        return $this->belongsTo(Domaine_indus::class,'id_domaine_indus','id');
    }
}
