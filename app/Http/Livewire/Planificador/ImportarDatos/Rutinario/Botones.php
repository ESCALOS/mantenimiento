<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Rutinario;

use Livewire\Component;

class Botones extends Component
{
    public $rutinario_id = 0;
    public $boton_activo = false;

    protected $listeners = ['obtenerRutinario'];

    public function obtenerRutinario($id){
        $this->rutinario_id = $id;
        $this->boton_activo = $id > 0;
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.rutinario.botones');
    }
}
