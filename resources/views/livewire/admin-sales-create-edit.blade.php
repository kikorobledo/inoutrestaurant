<div>

    @if($sale_edit)

        <h1 class="titulo-seccion text-3xl font-thin text-gray-500">Actualizar Venta</h1>

    @else

        <h1 class="titulo-seccion text-3xl font-thin text-gray-500">Nueva Venta</h1>

    @endif

    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 sm:grid-cols-2 gap-4 w-full mt-5">

        <div class="rounded-xl border-t-2 border-green-500 shadow-lg p-8 bg-white col-span-2 lg:col-span-1">

            <div class="w-full  mx-auto">

                <div class="xl:w-2/4 mx-auto">

                    <div class="mt-1 relative rounded-md shadow-sm mb-3">

                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm mr-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                            </span>
                        </div>

                        <input type="text" readonly class="bg-white rounded  text-sm w-full pl-10 " value="{{ auth()->user()->name }}">

                    </div>

                    <div x-data="selectSearch({{$tables}})" class=" bg-white rounded text-sm w-full border border-gray-500 relative mb-3"
                        x-init="init('mesa')"
                        @click.away="closeSelect()"
                        @keydown.escape="closeSelect()">

                        <div class="flex justify-between w-full p-2 " @click="open=true">
                            <span class="text-gray-500 sm:text-sm flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>

                                    @if($sale_edit)
                                        <p class="text-black">{{ $table_name }}</p>
                                    @else
                                        <p class="text-black" x-text="placeholder"></p>
                                    @endif
                            </span>

                            <span class="text-red-500 sm:text-sm float-right hidden" id="table_null_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                            </span>

                        </div>

                        <div class="mt-0.5 w-full bg-white border-gray-300 rounded-b-md border absolute top-full left-0 z-30" x-show="open">

                            <ul class="h-full p-2 w-full flex flex-col">
                                <template x-for="table in Object.values(options)">

                                    <span
                                        x-text="table.name"
                                        class="hover:bg-gray-100 py-1 px-4 rounded-xl"
                                        x-on:click.prevent.stop="selected(table.name)"
                                        x-on:click="$wire.updateTable(table.name, table.id)">
                                    </span>

                                </template>
                            </ul>

                        </div>

                    </div>

                    <div x-data="selectSearch({{$clients}})" class=" bg-white rounded text-sm w-full border border-gray-500 relative mb-3"
                        x-init="init('cliente')"
                        @click.away="closeSelect()"
                        @keydown.escape="closeSelect()">

                        <div class="flex justify-between w-full p-2 " @click="open=true">
                            <span class="text-gray-500 flex sm:text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-4 ">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>

                                @if($sale_edit)
                                    <p class="text-black">{{ $client_name }}</p>
                                @else
                                    <p class="text-black" x-text="placeholder"></p>
                                @endif

                            </span>

                            <span class="text-red-500 sm:text-sm float-right hidden" id="client_null_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                            </span>
                        </div>

                        <div class="mt-0.5 w-full bg-white border-gray-300 rounded-b-md border absolute top-full left-0 z-30" x-show="open">

                            <div class="relative z-30 w-full p-2 bg-white">

                                <input placeholder="Buscar.." type="text" x-model="search" x-on:click.prevent.stop="open=true" class="block w-full  border border-gray-300 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm sm:leading-5">

                            </div>

                            <ul class="h-full p-2 w-full flex flex-col">
                                <template x-for="client in Object.values(options)">

                                    <span
                                        x-text="client.name"
                                        class="hover:bg-gray-100 py-1 px-4 rounded-xl"
                                        x-on:click.prevent.stop="selected(client.name)"
                                        x-on:click="$wire.updateClient(client.name, client.id)">
                                    </span>

                                </template>
                            </ul>

                        </div>

                    </div>

                    <div x-data="selectSearch({{$products}})" class=" bg-white rounded text-sm w-full border border-gray-500 relative mb-3 lg:hidden"
                        x-init="init('producto')"
                        @click.away="closeSelect()"
                        @keydown.escape="closeSelect()">

                        <div class="flex justify-between w-full p-2 " @click="open=true">
                            <span class="text-gray-500 flex sm:text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                  </svg>

                                <p class="text-black">Seleccione un Producto</p>
                            </span>
                        </div>

                        <div class="mt-0.5 w-full bg-white border-gray-300 rounded-b-md border absolute top-full left-0 z-30" x-show="open">

                            <div class="relative z-30 w-full p-2 bg-white">

                                <input placeholder="Buscar.." type="text" x-model="search" x-on:click.prevent.stop="open=true" class="block w-full  border border-gray-300 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm sm:leading-5">

                            </div>

                            <ul class="h-full p-2 w-full flex flex-col">
                                <template x-for="product in Object.values(options)">

                                    <span
                                        x-text="product.name"
                                        class="hover:bg-gray-100 py-1 px-4 rounded-xl"
                                        x-on:click.prevent.stop="selected(product.name)"
                                        x-on:click="$wire.addProduct(product.id)">
                                    </span>

                                </template>
                            </ul>

                        </div>

                    </div>

                </div>

                @if($sale != null)

                    <div class="overflow-x-auto">

                        <table class="rounded-lg shadow-xl w-full overflow-hidden table-auto  xl:table-fixed">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-xs text-gray-500 uppercase text-left traling-wider">
                                    <th class="px-2 py-3">Producto</th>
                                    <th class="px-2 py-3">Cantidad</th>
                                    <th class="px-2 py-3 lg:hidden xl:block">Precio</th>
                                    <th class="px-2 py-3">Total</th>
                                    <th class="px-2 py-3"></th>
                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @forEach($saleDetails as $saleDetail)

                                    <tr class="text-sm text-gray-500 bg-white">
                                        <td class="px-2 py-3 w-full text-gray-800">
                                            {{ $saleDetail->product_name }}
                                            <br>
                                            @if(count($saleDetail->extras) > 0)
                                                @foreach($saleDetail->extras as $extra)
                                                    <p class="text-xs">+{{ $extra->name }}<br></p>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="px-2 py-3 w-full text-gray-800 text-sm mx-auto">
                                            <div class="flex">
                                            <button @if($saleDetail->quantity == 1) disabled @endif class="text-white mr-1 px-2 rounded-full cursor-pointer focus:outline-none @if($saleDetail->quantity == 1) bg-gray-200 @else bg-gray-600 @endif"
                                                wire:click="increaseDecreaseSaleDetail({{$saleDetail->id}}, -1)">
                                                -
                                            </button>
                                                {{ $saleDetail->quantity }}
                                            <button class="bg-gray-600 text-white  ml-1 px-2 rounded-full cursor-pointer focus:outline-none"
                                                wire:click="increaseDecreaseSaleDetail({{$saleDetail->id}}, 1)">
                                                +
                                            </button>
                                        </div>
                                        </td>
                                        <td class="px-2 py-3 w-full text-gray-800 "><p class ="">${{  number_format($saleDetail->product_price,2) }}</p></td>
                                        <td class="px-2 py-3 w-full text-gray-800"><p class ="">${{ number_format($saleDetail->product_price * $saleDetail->quantity,2) }}</p></td>
                                        <td class="px-2 py-3 w-full text-gray-800">
                                            @if($saleDetail->status == 'confirmed')
                                                <span type="button" class="bg-yellow-500 py-2 px-2 text-white rounded-full cursor-auto focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg"  class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                    </svg>
                                                </span>
                                            @else
                                                <button
                                                    wire:click="deleteSaleDetail({{$saleDetail->id}})"
                                                    wire:loading.attr="disabled"
                                                    class="bg-red-500 py-2 px-2 text-white rounded-full cursor-pointer focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                @endforEach
                            </tbody>

                            <tfoot class="border-b border-gray-300 rounded-lg bg-gray-50">
                                <tr>
                                    <td colspan="5" class="py-2 px-5 text-center text-lg font-bold">
                                        TOTAL: $ {{  number_format($sale->total_price,2) }}
                                    </td>
                                </tr>
                            </tfoot>

                        </table>

                    </div>

                    <div class="xl:w-2/4 mx-auto">

                        @if($saleConfirmed)

                            <button wire:click="openModal" class="bg-green-400 hover:shadow-lg text-white text-lg text-center font-bold mt-3 px-3 py-2 rounded-full mr-2 hover:bg-tellow-700 w-full focus:outline-none">Cobrar</button>

                        @else

                            <button wire:click="confirmSale" class="bg-yellow-400 hover:shadow-lg text-white text-lg text-center font-bold mt-3 px-3 py-2 rounded-full mr-2 hover:bg-tellow-700 w-full focus:outline-none">Confirmar venta</button>

                        @endif

                    </div>

                @endif

            </div>

        </div>

        <div class="rounded-xl border-t-2 border-blue-500 bg-white p-3 shadow hidden lg:block">

            <div class="overflow-x-auto">

                <input type="text" wire:model="search" placeholder="Buscar" class="bg-white rounded-full text-sm my-3 float-right mr-3">

                <table class="rounded-lg shadow-xl w-full overflow-hidden table-auto xl:table-fixed">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">
                            <th wire:click="order('name')" class="cursor-pointer px-2 py-3">
                                Nombre
                                @if($sort == 'name')
                                    @if($direction == 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>
                                    @endif
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                @endif
                            </th>
                            <th wire:click="order('sale_price')" class="cursor-pointer px-2 py-3 hidden xl:block">
                                Precio
                                @if($sort == 'sale_price')
                                    @if($direction == 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>
                                    @endif
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                @endif
                            </th>
                            @if(auth()->user()->roles[0]->name != 'Empleado')
                                <th class="px-2 py-3">Acciones</th>
                            @endif
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse($products2 as $product)

                            <tr class="text-xs text-gray-500 bg-white">
                                <td class="p-3 text-gray-800 text-center">

                                    <div class="flex items-center justify-center lg:justify-start ">
                                        <div class="flex-shrink">
                                            @if($product->image_url)
                                                <img class="w-10 lg:w-10 rounded" src="/storage/{{ $product->image_url }}" alt="{{ $product->name }}">
                                            @else
                                                <img class="w-10 lg:w-10 rounded" src="{{ asset('storage/img/icono.png') }}" alt="{{ $product->name }}">
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm text-left font-medium text-gray-900 mb-1">
                                                {{ $product->name }}
                                            </div>
                                            <div>
                                                @if($product->stock == -1)
                                                    <span class="bg-gray-400 text-white text-xs rounded-full  px-4 float-left">Alimento</span>
                                                @elseif($product->stock >= 20)
                                                    <span class="bg-green-400 text-white text-xs rounded-full  px-4 float-left">Stock: {{ $product->stock }}</span>
                                                @elseif($product->stock <= 20 && $product->stock > 10)
                                                    <span class="bg-yellow-400 text-white text-xs rounded-full  px-4 float-left">Stock: {{ $product->stock }}</span>
                                                @elseif($product->stock <= 10)
                                                    <span class="bg-red-400 text-white text-xs rounded-full  px-4 float-left">Stock: {{ $product->stock }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class=" w-full p-3 text-gray-800 text-center hidden xl:block">
                                    ${{ $product->sale_price }}
                                </td>
                                @if(auth()->user()->roles[0]->name != 'Empleado')
                                    <td class=" w-full lg:w-auto p-3 text-gray-800 text-center ">

                                        <div class="flex justify-center lg:justify-start">

                                            @if($product->stock != -1)

                                                <button wire:click="addProduct({{$product->id}})"  class="bg-green-400 hover:shadow-lg text-white  text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-green-700 flex focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <p>Agregar</p>
                                                </button>

                                            @else

                                                <button wire:click="openModalExtras({{$product->id}})"  class="bg-green-400 hover:shadow-lg text-white  text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-green-700 flex focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <p>Agregar</p>
                                                </button>

                                            @endif

                                        </div>

                                    </td>
                                @endif
                            </tr>
                        @empty

                            <tr>
                                <td class="p-4 text-center">No hay productos para mostrar</td>
                            </tr>

                        @endforelse

                    </tbody>

                    <tfoot class="border-b border-gray-300 bg-gray-50">
                        <tr>
                            <td colspan="3" class="py-2 px-5 ">
                                {{ $products2->links()}}
                            </td>
                        </tr>
                    </tfoot>

                </table>

            </div>

        </div>

    </div>


    <x-jet-dialog-modal wire:model="modalExtras" maxWidth="md">

        <x-slot name="title">
            Extras
        </x-slot>

        <x-slot name="content">

            @if($product_)

                <div class="flex flex-wrap overflow-y-auto max-h-60">
                    @foreach($product_->extras as $extra)

                        <label class="border border-gray-500 px-2 rounded-full py-1 mr-2 mb-1 text-sm cursor-pointer text-xs">
                            <input class="bg-white rounded" type="checkbox" wire:model="selected_extras" value="{{ $extra->id }}">
                            {{ $extra->name }} / ${{$extra->price}}
                        </label>

                    @endforeach
                </div>
            @endif

        </x-slot>

        <x-slot name="footer">
            <div class="float-righ">

                <button
                    wire:click="addProduct({{$product_}})"
                    wire:loading.attr="disabled"
                    type="button"
                    class="bg-green-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-green-700 flaot-left focus:outline-none">
                    Agregar
                </button>

            </div>
        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="modal" maxWidth="md">

        <x-slot name="title">
            Cobrar
        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">
                <div class="flex-auto ">
                    <div>
                        <Label>Tipo de pago</Label>
                    </div>
                    <div>

                        <select wire:model="payment_type" class="bg-white rounded text-sm w-full">

                            <option value="">Seleccione un tipo de pago</option>
                            <option value="cash">Pago en efectivo</option>
                            <option value="card">Pago con tarjeta</option>

                        </select>
                    </div>
                    <div>
                        @error('payment_type') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">
                    <div>
                        <Label>Total</Label>
                    </div>
                    <div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">
                                $
                                </span>
                            </div>
                            @if($sale)
                            <p type="number" class="bg-white rounded text-sm w-full pl-7 " >{{ number_format($sale->total_price,2) }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex-auto ">
                    <div>
                        <Label>Total recibido</Label>
                    </div>
                    <div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">
                                $
                                </span>
                            </div>
                            <input type="number" class="bg-white rounded text-sm w-full pl-7 " wire:keyup="calculateChange" wire:model="total_recived" placeholder="0.00" min="0">
                        </div>
                    </div>
                    <div>
                        @error('total_recived') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex-auto ">
                    <div>
                        <Label>Cambio</Label>
                    </div>
                    <div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">
                                $
                                </span>
                            </div>
                            <input  type="text" class="bg-white rounded text-sm w-full pl-7 " value="{{ number_format($change,2)}}" placeholder="0.00" readonly>
                        </div>
                    </div>
                    <div>
                        @error('change') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="float-righ">

                @if($sale != null)
                    <a
                        wire:click="pay"
                        wire:loading.attr="disabled"
                        wire:target="create"
                        class="disabled:opacity-25 bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">
                        Cobrar
                    </a>
                @endif

                <button
                    wire:click="closeModal"
                    wire:loading.attr="disabled"
                    type="button"
                    class="bg-red-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-red-700 flaot-left focus:outline-none">
                    Cerrar
                </button>

            </div>
        </x-slot>

    </x-jet-dialog-modal>

    <script>
        function selectSearch(data){

            return{
                data:data,
                placeholder: "",
                open:false,
                search:'',
                options: {},
                limit:40,
                init(modelo){

                    if(modelo == "cliente")
                        this.placeholder ="Seleccione un cliente";
                    else if(modelo == "producto")
                        this.placeholder ="Seleccione un producto";
                    else
                        this.placeholder ="Seleccione una mesa";

                    this.resetOptions();

                    this.$watch('search', ((values) => {

                        if (!this.open || !values) {
                            this.resetOptions()
                            return
                        }
                        this.options = Object.keys(this.data)
                            .filter((key) => this.data[key].name.toLowerCase().includes(values.toLowerCase()))
                            .slice(0, this.limit)
                            .reduce((options, key) => {
                                options[key] = this.data[key]
                                return options
                            }, {})
                    }))
                },
                resetOptions: function() {
                    this.options = Object.keys(this.data)
                        .slice(0,this.limit)
                        .reduce((options, key) => {
                            options[key] = this.data[key]
                            return options
                        }, {})
                },
                closeSelect: function() {
                    this.open = false
                    this.search = ''
                },
                selected(name){
                    this.placeholder = name;
                    this.open = false;
                }
            }
        }

        window.addEventListener('pirnt-ticket', event => {
            const sale = event.detail.sale;

            var url = "{{route('admin.sales.receipt', '')}}"+"/"+sale;
            window.open(url, '_blank')
            window.location.href = "{{ route('admin.sales.index')}}"
        })

        window.addEventListener('unsetFields', event => {
            if(event.detail.client_id == null)
                document.getElementById('client_null_icon').classList.remove('hidden')

            if(event.detail.table_id == null)
                document.getElementById('table_null_icon').classList.remove('hidden');
        })

        let logComponentsData = function () {
            Livewire.components.components().forEach(component => {
                console.log("%cComponent: " + component.name, "font-weight:bold");
                console.log(component.data);
            });
        };

        document.addEventListener("livewire:load", function(event) {
            logComponentsData();

            Livewire.hook('message.processed', (message, component) => {
                logComponentsData();
            });
        });
    </script>

</div>
