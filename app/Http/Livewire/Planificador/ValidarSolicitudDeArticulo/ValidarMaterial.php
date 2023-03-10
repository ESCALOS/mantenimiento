<?php

namespace App\Http\Livewire\Planificador\ValidarSolicitudDeArticulo;

use App\Models\DetalleDeSolicitudDePedido;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ValidarMaterial extends Component
{
    public $open;
    public $codigo;
    public $articulo;
    public $unidad_de_medida;
    public $precio;
    public $cantidad;
    public $stock;
    public $almacen;
    public $detalle_id;
    public $estado;
    public $precio_total;

    protected $listeners = ['abrirModal'];

    public function mount($estado){
        $this->open = false;
        $this->codigo = "";
        $this->articulo = "";
        $this->unidad_de_medida = "";
        $this->precio = 0;
        $this->cantidad = 0;
        $this->stock = 0;
        $this->almacen = 0;
        $this->detalle_id = 0;
        $this->estado = $estado;
        $this->precio_total = 0;
    }

    public function updatedOpen(){
        if(!$this->open){
            $this->resetExcept('open','estado');
        }
    }

    public function abrirModal($detalle_id){
        $this->open = true;
        $this->detalle_id = $detalle_id;
        $this->obtenerDatos($detalle_id);
    }

    public function validar(){
        $detalle = DetalleDeSolicitudDePedido::find($this->detalle_id);
        if($this->cantidad > 0){
            $detalle->cantidad_validada = $this->cantidad;
            $detalle->precio = $this->precio;
            $detalle->estado = 'VALIDADO';

        }else{
            $detalle->estado = 'RECHAZADO';
            $detalle->cantidad_validada = 0;
        }
        $detalle->save();

        $this->resetExcept('estado');
        $this->emitTo('planificador.validar-solicitud-de-articulo.modal','obtenerDatos');
    }

    public function obtenerDatos($detalle_id){
        if($detalle_id > 0){
            $detalle = DB::table('lista_de_detalle_de_pedido')->where('id',$detalle_id)->first();
            $this->codigo = $detalle->codigo;
            $this->articulo = strtoupper($detalle->articulo);
            $this->unidad_de_medida = $detalle->unidad_de_medida;
            $this->cantidad = $detalle->cantidad_validada > 0 ? $detalle->cantidad_validada : $detalle->cantidad_solicitada;
            $this->precio = floatval($detalle->precio);
            $this->stock = floatval($detalle->stock);
            $this->almacen = floatval($detalle->almacen);
        }else{
            $this->resetExcept('open');
        }
    }

    public function render()
    {
        if($this->cantidad > 0 && $this->precio > 0){
            $this->precio_total = $this->cantidad * $this->precio;
        }else{
            $this->precio_total = 0;
        }

        return view('livewire.planificador.validar-solicitud-de-articulo.validar-material');
    }
}
