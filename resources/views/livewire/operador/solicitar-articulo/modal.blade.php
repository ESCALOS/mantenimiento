<div>
    @if($accion != "")
    <x-jet-dialog-modal maxWidth="sm" wire:model='open'>
        <x-slot name="title">
            Registrar
        </x-slot>
        <x-slot name="content">
            <div class="grid">
                @if ($accion == "pieza")
                <div>
                    <x-jet-label>Componente: </x-jet-label>
                    <select class="text-center form-control" style="width: 100%" wire:model='componente'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($componentes as $componente)
                        <option value="{{ $componente->Articulo->id }}">{{$componente->Articulo->codigo}} - {{$componente->Articulo->articulo}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div>
                    <x-jet-label>{{ ucfirst($accion) }}: </x-jet-label>
                    <select class="text-center form-control" style="width: 100%" wire:model='articulo'>
                        <option value="0">Seleccione una opción</option>
                        @foreach ($articulos as $articulo)
                        @if ($accion == "componente")
                        <option value="{{ $articulo->Articulo->id }}">{{$articulo->Articulo->codigo}} - {{$articulo->Articulo->articulo}}</option>
                        @elseif($accion == "pieza")
                        <option value="{{ $articulo->Pieza->id }}">{{$articulo->Pieza->codigo}} - {{$articulo->Pieza->articulo}}</option>
                        @elseif ($accion == "fungible" || $accion == "herramienta")
                        <option value="{{ $articulo->id }}">{{$articulo->codigo}} - {{$articulo->articulo}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-jet-label>Cantidad</x-jet-label>
                    <x-jet-input type="number" class="w-full" min="0" wire:model="cantidad"></x-jet-input>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:loading.attr="disabled" wire:click="registrar()">
                Guardar
            </x-jet-button>
            <div wire:loading wire:target="registrar">
                Registrando...
            </div>
            <x-jet-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cancelar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    @endif
</div>