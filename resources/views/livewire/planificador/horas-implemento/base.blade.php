<div>
    <div class="grid grid-cols-1 {{ $sede_id > 0 ? 'sm:grid-cols-2' : 'sm:grid-cols-1' }}">
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" id="id_implemento" style="width: 100%" wire:model='sede_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione una sede</option>
                @foreach ($sedes as $sede)
                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        @if ($sede_id > 0)
        <div class="p-4" style="padding-left: 1rem; padding-right:1rem">
            <select class="form-control" style="width: 100%" wire:model='operario_id'>
                <option value="0" class="font-bold text-center text-md">Seleccione el operario</option>
                @foreach ($operarios as $operario)
                <option value="{{ $operario->id }}">{{ $operario->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    @if ($operario_id > 0 && $implementos->count() > 0)
    <div style="display:flex; align-items:center;justify-content:center;margin-bottom:15px">
        <h1 class="text-2xl font-bold text-center">Implementos</h1>
    </div>
    <div class="grid grid-cols-1 gap-4 p-6 mt-4 sm:grid-cols-4">
        @foreach ($implementos as $implemento)
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center text-center">
                <h5 class="mb-1 text-lg font-medium text-gray-900 dark:text-white">{{ $implemento->ModeloDelImplemento->modelo_de_implemento }} {{ $implemento->numero }}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">Implemento</span>
                <div class="flex mt-4 space-x-3 lg:mt-6">
                    <button wire:click="$emit('mostrarComponentes',{{$implemento->id}})" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ver Componentes</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
