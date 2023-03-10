<?php

namespace App\Http\Livewire\Jefe\ProgramacionDeTractores;

use App\Exports\TractorScheduleExport;
use App\Models\ProgramacionDeTractor;
use App\Models\Sede;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Tabla extends Component
{
    use WithPagination;

    public $sede_id;
    public $supervisor_id;
    public $fecha;
    public $turno;
    public $fundo;
    public $lote;
    public $tractorista;
    public $tractor;
    public $implemento;
    public $labor;

    protected $listeners = ['obtenerSupervisor','filtrar','pdf','excel'];

    public function mount($sede_id){
        $this->sede_id = $sede_id;
        $this->supervisor_id = 0;
        $this->fecha = date('Y-m-d');
        $this->turno = "";
        $this->fundo = 0;
        $this->lote = 0;
        $this->tractorista = 0;
        $this->tractor = 0;
        $this->implemento = 0;
        $this->labor = 0;
    }

    public function obtenerSupervisor($sede_id,$supervisor_id){
        $this->resetExcept('fecha');
        $this->sede_id = $sede_id;
        $this->supervisor_id = $supervisor_id;
        $this->render();
    }

    public function filtrar($fecha,$turno,$fundo,$lote,$tractorista,$tractor,$implemento,$labor){
        $this->resetPage();
        $this->fecha = $fecha;
        $this->turno = $turno;
        $this->fundo = $fundo;
        $this->lote = $lote;
        $this->tractorista = $tractorista;
        $this->tractor = $tractor;
        $this->implemento = $implemento;
        $this->labor = $labor;
    }

    public function pdf(){
        if(ProgramacionDeTractor::where('fecha',$this->fecha)->where('esta_anulado',0)->doesntExist()){
            $this->emit('alerta',['center','warning','No existe programacion']);
        }else{
            $titulo = 'Programación del '.$this->fecha;
            if($this->supervisor_id > 0){
                $programaciones_am = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','MAÑANA')->where('supervisor',$this->supervisor_id)->where('esta_anulado',0)->get();
                $programaciones_pm = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','NOCHE')->where('supervisor',$this->supervisor_id)->where('esta_anulado',0)->get();
                $titulo = $titulo.' - '.User::find($this->supervisor_id)->name;
            }else{
                $programaciones_am = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','MAÑANA')->where('sede_id',$this->sede_id)->where('esta_anulado',0)->get();
                $programaciones_pm = ProgramacionDeTractor::where('fecha',$this->fecha)->where('turno','NOCHE')->where('sede_id',$this->sede_id)->where('esta_anulado',0)->get();
                $titulo = $titulo. ' - '.Sede::find($this->sede_id)->sede;
            }
            $titulo = $titulo.'.pdf';
            $data = [
                'programaciones_am' => $programaciones_am,
                'programaciones_pm' => $programaciones_pm,
                'fecha' => Carbon::parse($this->fecha)->isoFormat('dddd').','.Carbon::parse($this->fecha)->isoFormat(' DD').' de '.Carbon::parse($this->fecha)->isoFormat(' MMMM').' del '.Carbon::parse($this->fecha)->isoFormat(' Y'),
            ];
            $pdfContent = PDF::loadView('livewire.supervisor.programacion-de-tractores.pdf.programacion-de-tractores', $data)->setPaper('a4', 'landscape')->output();

            return response()->streamDownload(
                fn () => print($pdfContent),
                $titulo
            );
        }
    }

    public function excel(){
        if($this->fecha == ""){
            $this->emit('alerta',['center','warning','Ingrese la fecha']);
        }else{
            return Excel::download(new TractorScheduleExport($this->fecha,$this->sede_id,$this->supervisor_id),'Programacion de tractores del '.$this->fecha.'.xlsx');
        }
    }

    public function render()
    {
        $programacion_de_tractores = ProgramacionDeTractor::where('esta_anulado',0);

        if($this->supervisor_id > 0){
            $programacion_de_tractores = $programacion_de_tractores->where('supervisor',$this->supervisor_id);
        }else{
            $programacion_de_tractores = $programacion_de_tractores->where('sede_id',$this->sede_id);
        }

        if($this->fecha != "") {
            $programacion_de_tractores->where('fecha',$this->fecha);
        }

        if($this->turno != "") {
            $programacion_de_tractores->where('turno',$this->turno);
        }

        if($this->lote > 0){
            $programacion_de_tractores->where('lote_id',$this->lote);
        }else if($this->fundo > 0){
            $programacion_de_tractores->whereHas('Lote',function($q){
                $q->where('fundo_id',$this->fundo);
            });
        }

        if($this->tractorista > 0) {
            $programacion_de_tractores->where('tractorista',$this->tractorista);
        }

        if($this->tractor > 0) {
            $programacion_de_tractores->where('tractor_id',$this->tractor);
        }

        if($this->implemento > 0) {
            $programacion_de_tractores->whereHas('ImplementoProgramacion',function($q){
                $q->where('implemento_id',$this->implemento);
            });
        }

        if($this->labor > 0) {
            $programacion_de_tractores->where('labor_id',$this->labor);
        }
        if($this->fecha == ""){
            $total_tractores = "";
            $total_implementos = "";
        }else{
            $total_tractores = $programacion_de_tractores->count();
            $implementos_por_programacion = $programacion_de_tractores->withCount('ImplementoProgramacion')->get();
            $total_implementos = 0;
            foreach($implementos_por_programacion as $implemento_programacion){
                $total_implementos += $implemento_programacion->implemento_programacion_count;
            }
        }

        $programacion_de_tractores = $programacion_de_tractores->latest()->paginate(6);

        return view('livewire.jefe.programacion-de-tractores.tabla',compact('programacion_de_tractores','total_tractores','total_implementos'));
    }
}
