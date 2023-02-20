<div>
    @if ($programacion_de_tractores->count())
        <table class="w-full overflow-x-scroll table-fixed" wire:loading.remove wire:target="filtrar">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    <th class="py-3 text center">
                        <span class="hidden sm:block">Tractorista</span>
                        <img class="flex mx-auto sm:hidden" src="/img/tabla/tractorista.png" alt="tractortista" width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Tractor</span>
                        <img class="flex mx-auto sm:hidden" src="/img/tabla/tractor.svg" alt="tractor"
                            width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Implemento</span>
                        <img class="flex mx-auto sm:hidden" src="/img/tabla/implemento.png" alt="implemento" width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Día</span>
                        <img class="flex mx-auto sm:hidden" src="/img/tabla/fecha.svg" alt="fecha" width="28">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Lote</span>
                        <img class="flex mx-auto sm:hidden" src="/img/tabla/lote.png" alt="fecha" width="25">
                    </th>
                    <th class="py-3 text-center">
                        <span class="hidden sm:block">Labor</span>
                        <img class="flex mx-auto sm:hidden" src="/img/tabla/labor.svg" alt="labor" width="25">
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-light text-gray-600">
                @foreach ($programacion_de_tractores as $programacion_de_tractor)
                    <tr style="cursor:pointer" wire:click="seleccionar({{$programacion_de_tractor->id}})" class="border-b {{ $programacion_de_tractor->id == $programacion_id ? 'bg-blue-200' : '' }} border-gray-200">
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Tractorista->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Tractor->ModeloDeTractor->modelo_de_tractor }} {{ $programacion_de_tractor->Tractor->numero }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $programacion_de_tractor->Implemento->numero }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->fecha }}</span>
                                <div class="flex items-center justify-center">
                                    <img src="/img/tabla/{{ $programacion_de_tractor->turno == 'MAÑANA' ? 'sol' : 'luna' }}.svg" alt="turno" width="25">
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->Lote->lote }}</span>
                            </div>
                        </td>
                        <td class="px-2 py-3 text-center">
                            <div>
                                <span class="font-medium">{{ $programacion_de_tractor->labor->labor }}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="align-items:center;justify-content:center;margin-bottom:15px" wire:loading.flex wire:target="render">
            <div class="text-center">
                <h1 class="text-4xl font-bold">
                    CARGANDO DATOS...
                </h1>
            </div>
        </div>
    @else
        <div class="px-6 py-4">
            No existe ningún registro coincidente
        </div>
    @endif
        <div class="px-4 py-4">
            {{ $programacion_de_tractores->links() }}
        </div>
</div>
