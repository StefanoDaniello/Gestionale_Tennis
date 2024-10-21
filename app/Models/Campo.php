<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    use HasFactory;
    protected  $guarded=[];
    protected $table = 'campi';

    public function prenotazione(){
        return $this->belongsTo(Prenotazione::class, 'campo_id');
    }

}
