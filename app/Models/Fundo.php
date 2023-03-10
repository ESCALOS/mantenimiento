<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Sede(){
        return $this->belongsTo(Sede::class);
    }

    public function Lotes(){
        return $this->hasMany(Lote::class);
    }
}
