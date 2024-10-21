<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'prenotazioni';

    public function campo()
    {
        return $this->belongsTo(Campo::class, 'campo_id'); 
    }
    public function prenotazioni(){
        return $this->hasMany(Prenotazione::class, 'campo_id');
    }
}
