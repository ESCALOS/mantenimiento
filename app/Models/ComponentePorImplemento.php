<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentePorImplemento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function componentes_para_mantenimientos(){
        return $this->morphMany(ComponentesParaMantenimiento::class,'modelo');
    }
}
