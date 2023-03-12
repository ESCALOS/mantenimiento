<div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-1" wire:loading.remove>
    @if($stock->count())
        <div style="overflow:auto">
            <table class="w-full min-w-max">
                <thead>
                    <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                        <th class="py-3 text-center">
                            <span>Articulo</span>
                        </th>
                        <th class="py-3 text-center">
                            <span>Cantidad</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light text-gray-600">
                    @foreach ($stock as $stock_sede)
                        <tr class="border-b border-gray-200 unselected">
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-black  {{$stock_sede->Articulo->tipo == "PIEZA" ? 'text-red-500' : ( $stock_sede->Articulo->tipo == "COMPONENTE" ? 'text-green-500' : ($stock_sede->Articulo->tipo == "COMPONENTE" ? 'text-green-500' : ($stock_sede->Articulo->tipo == "FUNGIBLE" ? 'text-amber-500' : 'text-blue-500')))}} ">{{$stock_sede->Articulo->articulo}} </span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div>
                                    <span class="font-medium">{{$stock_sede->cantidad}} </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $stock->links() }}
        </div>
    @endif
</div>
