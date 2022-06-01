<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cycle_formation',
        'id_user',
        'etat'
        ];
    protected $primaryKey = ['id_cycle_formation', 'id_user'];
    public $incrementing = false;

    protected $with = ['clients'];

    public function clients (){
        return $this->belongsTo(User::class,'id_user','id');
    }
}
