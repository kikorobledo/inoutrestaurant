<div class="">

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>

    <div class="mb-5">

        <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-5">Ventas</h1>

        <div>

            <input type="text" wire:model="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

            <a href="{{ route('admin.sales.create') }}"  class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none hidden md:block">Agregar Nueva Venta</a>
            <a href="{{ route('admin.sales.create') }}" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none md:hidden">+</a>

        </div>

    </div>

    @if($sales->count())

        <table class="rounded-lg shadow-xl w-full overflow-hidden">

            <thead class="border-b border-gray-300 bg-gray-50">

                <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">
                    <th wire:click="order('id')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        #
                        @if($sort == 'id')
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
                    <th wire:click="order('table_id')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Mesa
                        @if($sort == 'table_id')
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
                    <th wire:click="order('total_price')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Total
                        @if($sort == 'total_price')
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
                    <th wire:click="order('total_recived')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Total Recivido
                        @if($sort == 'total_recived')
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
                    <th wire:click="order('change')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Cambio
                        @if($sort == 'change')
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
                    <th wire:click="order('payment_type')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Tipo de pago
                        @if($sort == 'payment_type')
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
                    <th wire:click="order('status')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Estado
                        @if($sort == 'status')
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
                    <th wire:click="order('created_at')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Registro
                        @if($sort == 'created_at')
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
                    <th wire:click="order('updated_at')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Actualizado
                        @if($sort == 'updated_at')
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
                    <th class="px-6 py-3 hidden lg:table-cell">Acciones</th>
                </tr>

            </thead>

            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                @foreach($sales as $sale)

                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">#</span>
                            {{ $sale->sale_number }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>
                            <div class="flex items-center justify-center lg:justify-start">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 ">
                                        @if($sale->table)
                                            {{$sale->table->name}}
                                        @else
                                            Venta de mostrador
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Total</span>
                            ${{ number_format($sale->total_price, 2) }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center  lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Total Recivido</span>
                            ${{ number_format($sale->total_recived, 2) }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Cambio</span>
                            ${{ number_format($sale->change, 2) }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl ">Tipo de pago</span>
                            @if($sale->payment_type)
                                <p class="capitalize ">{{ $sale->payment_type }}</p>
                            @else
                                Pendiente
                            @endif

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Estado</span>
                            @if($sale->status == 'unpaid')
                                <span class="bg-red-400 text-white rounded-full py-1 px-4 truncate">Sin pagar</span>
                            @else
                                <span class="bg-green-400 text-white rounded-full py-1 px-4 truncate">Pagado</span>
                            @endif

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>
                            @if($sale->created_by != null)
                                <span class="font-semibold">Registrado por: {{$sale->createdBy->name}}</span> <br>
                            @endif
                            {{ $sale->created_at }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>
                            @if($sale->updated_by != null)
                                <span class="font-semibold">Actualizado por: {{$sale->updatedBy->name}}</span> <br>
                            @endif
                            {{ $sale->updated_at }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                            <div class="flex justify-center ">

                                @if($sale->status == 'unpaid')

                                    <a href="{{ route('admin.sales.edit', $sale)}}" class="bg-blue-400 hover:shadow-lg text-white  text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-blue-700 flex focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <p>Editar</p>
                                    </a>

                                @else

                                    <button wire:click="openModalShow({{ $sale->id }})"  class="bg-green-400 hover:shadow-lg text-white  text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-green-700 flex focus:outline-none items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        <p>Ver</p>
                                    </button>

                                @endif

                                @if(auth()->user()->roles[0]->name == 'Administrador Tienda' || auth()->user()->roles[0]->name == 'Administrador')
                                    <button wire:click="openModalDelete({{$sale}})" class="bg-red-400 hover:shadow-lg text-white  text-xs md:text-sm px-3 py-2 rounded-full hover:bg-red-700 flex focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <p>Eliminar</p>
                                    </button>
                                @endif

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

            <tfoot class="border-b border-gray-300 bg-gray-50">
                <tr>
                    <td colspan="10" class="py-2 px-5">
                        {{ $sales->links()}}
                    </td>
                </tr>
            </tfoot>

        </table>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

    <x-jet-dialog-modal wire:model="modal" maxWidth="md">

        <x-slot name="title">
            Venta # @if($sale_active){{ $sale_active->sale_number }}@endif
        </x-slot>

        <x-slot name="content">
            @if($sale_active)
                <div class="mb-5">

                    <div>
                        <div>
                            <Label>Registrada por</Label>
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm mb-3">

                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    </span>
                                </div>
                                <p type="number" class="mt-1 bg-white rounded text-sm w-full pl-10 " >{{ $sale_active->createdBy->name }}</p>
                            </div>

                        </div>
                    </div>

                    <div>
                        <div>
                            <Label>Mesa</Label>
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm mb-3">

                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <p type="number" class="mt-1 bg-white rounded text-sm w-full pl-10 " >{{ $sale_active->table_name }}</p>
                            </div>

                        </div>
                    </div>

                    <div class=" ">
                        <div>
                            <Label>Cliente</Label>
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm mb-3">

                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                    </span>
                                </div>
                                <p type="number" class="mt-1 bg-white rounded text-sm w-full pl-10 " >{{ $sale_active->client_name }}</p>
                            </div>

                        </div>

                    </div>

                    <div >
                        <div>
                            <Label>Tipo de pago</Label>
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm mb-3">

                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                    </span>
                                </div>
                                @if($sale->payment_type == 'cash')
                                    <p type="number" class="mt-1 bg-white rounded text-sm w-full pl-10 " >Efectivo</p>
                                @else
                                    <p type="number" class="mt-1 bg-white rounded text-sm w-full pl-10 " >Tarjeta</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div >
                        <div>
                            <Label>Total</Label>
                        </div>
                        <div class="mb-3">
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                    $
                                    </span>
                                </div>
                                <p type="number" class="mt-1 bg-white rounded text-sm w-full pl-7 " >{{ number_format($sale_active->total_price,2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class=" ">
                        <div>
                            <Label>Total recibido</Label>
                        </div>
                        <div class="mb-3">
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                    $
                                    </span>
                                </div>
                                <p type="number" class="bg-white rounded text-sm w-full pl-7 " >{{ number_format($sale_active->total_recived,2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class=" ">
                        <div>
                            <Label>Cambio</Label>
                        </div>
                        <div class="mb-3">
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                    $
                                    </span>
                                </div>
                                @if($sale_active)
                                <p type="number" class="bg-white rounded text-sm w-full pl-7 " >{{ number_format($sale_active->change,2) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">

                        <table class="rounded-lg shadow-xl w-full overflow-hidden table-auto  xl:table-fixed">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-sm text-gray-500 uppercase text-left traling-wider">
                                    <th class="px-2 py-3">Producto</th>
                                    <th class="px-2 py-3">Cantidad</th>
                                    <th class="px-2 py-3 lg:hidden xl:block">Precio</th>
                                    <th class="px-2 py-3">Total</th>
                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @forEach($sale_active->saleDetails as $saleDetail)

                                    <tr class="text-sm text-gray-500 bg-white">
                                        <td class="px-2 py-3 w-full text-gray-800 text-sm">
                                            {{ $saleDetail->product_name }}
                                            <br>
                                            @if(count($saleDetail->extras) > 0)
                                                @foreach($saleDetail->extras as $extra)
                                                    <p class="text-xs">+{{ $extra->name }}</p>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="px-2 py-3 w-full text-gray-800 text-sm mx-auto text-center"> {{ $saleDetail->quantity }}</td>
                                        <td class="px-2 py-3 w-full text-gray-800 "><p class ="">${{  number_format($saleDetail->product_price,2) }}</p></td>
                                        <td class="px-2 py-3 w-full text-gray-800"><p class ="">${{ number_format($saleDetail->product_price * $saleDetail->quantity,2) }}</p></td>
                                    </tr>

                                @endforEach
                            </tbody>

                        </table>

                    </div>

                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <div class="float-righ">
                @if($sale_active)
                    <a
                        href="{{ route('admin.sales.receipt', $sale_active->id) }}"
                        target="_blank"
                        wire:loading.attr="disabled"
                        wire:target="create"
                        class="disabled:opacity-25 bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">
                        Imprimir ticket
                    </a>
                @endif

                <button
                    wire:click="closeModal"
                    type="button"
                    class="bg-red-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-red-700 flaot-left focus:outline-none">
                    Cerrar
                </button>

            </div>
        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="modalDelete">
        <x-slot name="title">
            Eliminar Venta
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar la venta?, No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                No
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete()" wire:loading.attr="disabled">
                Borrar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <script>

        window.addEventListener('showMessage', event => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: event.detail[0],
                title: event.detail[1]
            })
        })

    </script>

    <script>
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
