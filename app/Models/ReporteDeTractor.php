<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteDeTractor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ProgramacionDeTractor(){
        return $this->belongsTo(ProgramacionDeTractor::class);
    }

    public function Labor(){
        return $this->belongsTo(Labor::class);
    }

    public function Implemento(){
        return $this->belongsTo(Implemento::class);
    }

    public function Lote(){
        return $this->belongsTo(Lote::class);
    }

    public function Asistente(){
        return $this->belongsTo(User::class,'asistente');
    }

    public function ImplementoProgramacion() {
        return $this->hasMany(ImplementoProgramacion::class);
    }
}
