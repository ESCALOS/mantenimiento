<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Implemento;

use Livewire\Component;

class Botones extends Component
{
    public $implemento_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerImplemento'];

    public function obtenerImplemento($id){
        $this->implemento_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.implemento.botones');
    }
}
