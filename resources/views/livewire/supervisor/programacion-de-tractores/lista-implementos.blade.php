<div>
    <x-jet-dialog-modal wire:model='open' maxWidth="sm">
        <x-slot name="title">
            <select class="form-control" id="id_implemento" style="width: 100%" wire:model='supervisor'>
                @foreach ($supervisores as $supervisor)
                <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                @endforeach
            </select>
        </x-slot>
        <x-slot name="content">
            <div class="py-2" wire:loading.remove>
                <select class="form-control" id="id_implemento" style="width: 100%" wire:model='modelo_de_implemento_id'>
                    <option value="0">Seleccione un modelo</option>
                    @foreach ($modelos_de_implemento as $modelo_de_implemento)
                    <option value="{{ $modelo_de_implemento->id }}">{{ $modelo_de_implemento->modelo_de_implemento }}</option>
                    @endforeach
                </select>
            </div>
            @if (!empty($implemento))
            <table class="w-full min-w-max" wire:loading.remove>
                <thead>
                    <tr>
                        <th class="text-white bg-green-600">ASIGNADO</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light text-gray-600">
                        @foreach ($implementos_asignados as $implemento)
                        <tr wire:click="toggleImplemento({{ $implemento->id }})" class="border-b border-gray-200 unselected">
                            <td class="py-4 text-center">
                                <div>
                                    <span class="font-medium">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @endif
            <table class="w-full min-w-max" wire:loading.remove>
                <thead>
                    <tr class="text-white bg-amber-600">
                        <th>NO ASIGNADO</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light text-gray-600">
                    @if ($modelo_de_implemento_id > 0)
                        @foreach ($implementos as $implemento)
                        <tr wire:click="toggleImplemento({{ $implemento->id }})" class="border-b border-gray-200 unselected">
                            <td class="py-4 text-center">
                                <div>
                                    <span class="font-medium">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div style="align-items:center;justify-content:center;margin-bottom:10px" wire:loading.flex>
                <div class="text-center">
                    <h1 class="text-4xl font-bold">
                        CARGANDO DATOS...
                    </h1>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer" class="hidden">

        </x-slot>
    </x-jet-dialog-modal>
</div>
