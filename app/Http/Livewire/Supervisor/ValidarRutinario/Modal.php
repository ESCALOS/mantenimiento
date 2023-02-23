<?php

namespace App\Http\Livewire\Supervisor\ValidarRutinario;

use App\Models\ProgramacionDeTractor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{
    public $open;
    public $fecha;
    public $turno;
    public $rutinario;
    public $accion;

    protected $listeners = ['abrirModal'];

    public function mount(){
        $this->open = false;
        $this->fecha = date('Y-m-d');
        $this->turno = "MAÑANA";
        $this->rutinario = 0;
    }

    public function abrirModal($programacion){
        $this->rutinario = $programacion;
        if($programacion > 0){
            $this->accion = "editar";
            $this->emitTo('supervisor.validar-rutinario.tareas','mostrarTareas',$this->rutinario);
        }else{

            $this->accion = "crear";
        }
        $this->open = true;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->reset('rutinario');
            $this->emitTo('supervisor.validar-rutinario.tareas','mostrarTareas',$this->rutinario);
            $this->emitTo('supervisor.validar-rutinario.tabla','render');
        }
    }

    public function updatedRutinario(){
        $this->emitTo('supervisor.validar-rutinario.tareas','mostrarTareas',$this->rutinario);
    }

    public function render()
    {
        $programaciones = ProgramacionDeTractor::doesnthave('Rutinarios')->where('fecha',$this->fecha)->where('turno',$this->turno)->where('validado_por',Auth::user()->id)->where('esta_anulado',0)->get();

        return view('livewire.supervisor.validar-rutinario.modal',compact('programaciones'));
    }
}
