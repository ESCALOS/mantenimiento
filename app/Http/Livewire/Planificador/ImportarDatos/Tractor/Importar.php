<?php

namespace App\Http\Livewire\Planificador\ImportarDatos\Tractor;

use App\Imports\TractorsImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Importar extends Component
{
    use WithFileUploads;

    public $open;
    public $archivo;

    protected $listeners = ['abrirModal'];

    public function mount()
    {
        $this->open = false;
    }

    public function rules(){
        return [
            'archivo' => 'required|file|mimes:xlsx'
        ];
    }

    public function abrirModal(){
        $this->open = true;
    }

    public function importar(){
        $this->validate();
        try {
            Excel::import(new TractorsImport, $this->archivo);
            $this->emit('alerta',['center','success','Archivo Importado']);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $errores = $e->failures();
            $this->emit('alerta',['center','warning',$errores[0]->errors()]);
        }
    }

    public function render()
    {
        return view('livewire.planificador.importar-datos.tractor.importar');
    }
}
