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

        <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-5">Productos</h1>

        <div>

            <input type="text" wire:model="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

            @if(auth()->user()->roles[0]->name != 'Empleado')
                <button wire:click="openModalCreate" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none hidden md:block">Agregar Nuevo Producto</button>
                <button wire:click="openModalCreate" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none md:hidden">+</button>
            @endif

        </div>

    </div>

    @if($products->count())

        <table class="rounded-lg shadow-xl w-full overflow-hidden table-auto">

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
                    <th wire:click="order('name')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
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
                    <th wire:click="order('description')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Descripción
                        @if($sort == 'description')
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
                    <th wire:click="order('stock')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Stock
                        @if($sort == 'stock')
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
                    <th wire:click="order('purchase_price')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Precio de compra
                        @if($sort == 'purchase_price')
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
                    <th wire:click="order('sale_price')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Precio de venta
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
                    <th wire:click="order('category_id')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Categoría
                        @if($sort == 'category_id')
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
                    @if(auth()->user()->roles[0]->name != 'Empleado')
                        <th class="px-6 py-3 hidden lg:table-cell">Acciones</th>
                    @endif
                </tr>

            </thead>

            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                @foreach($products as $product)

                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">#</span>

                            {{ $product->product_number }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>
                            <div class="flex items-center justify-center lg:justify-start">
                                <div class="flex-shrink-0 ">
                                    @if($product->image_url)
                                        <img class="w-10 lg:w-20 rounded" src="/storage/{{ $product->image_url }}" alt="{{ $product->name }}">
                                    @else
                                        <img class="w-10 lg:w-20 rounded" src="{{ asset('storage/img/icono.png') }}" alt="{{ $product->name }}">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                    {{ $product->name }}
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Descripción</span>
                            {{ $product->description }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center  lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Stock</span>

                            @if($product->stock == -1)
                                <span class="bg-gray-400 text-white rounded-full py-1 px-4">Alimento</span>
                            @elseif($product->stock >= 20)
                                <span class="bg-green-400 text-white rounded-full py-1 px-4">{{ $product->stock }}</span>
                            @elseif($product->stock <= 20 && $product->stock > 10)
                                <span class="bg-yellow-400 text-white rounded-full py-1 px-4">{{ $product->stock }}</span>
                            @elseif($product->stock <= 10)
                                <span class="bg-red-400 text-white rounded-full py-1 px-4">{{ $product->stock }}</span>
                            @endif

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Precio de compra</span>
                            ${{ $product->purchase_price }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Precio de venta</span>
                            ${{ $product->sale_price }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Categoría</span>
                            {{ $product->category->name }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>
                            @if($product->created_by != null)
                                <span class="font-semibold">Registrado por: {{$product->createdBy->name}}</span> <br>
                            @endif
                            {{ $product->created_at }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>
                            @if($product->updated_by != null)
                                <span class="font-semibold">Actualizado por: {{$product->updatedBy->name}}</span> <br>
                            @endif
                            {{ $product->updated_at }}

                        </td>
                        @if(auth()->user()->roles[0]->name != 'Empleado')
                            <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                <div class="flex justify-center lg:justify-start">

                                    <button wire:click="openModalEdit({{$product}})" class="bg-blue-400 hover:shadow-lg text-white  text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-blue-700 flex focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <p>Editar</p>
                                    </button>

                                    @if(auth()->user()->roles[0]->name != 'Empleado Especial')
                                        <button wire:click="openModalDelete({{$product}})" class="bg-red-400 hover:shadow-lg text-white  text-xs md:text-sm px-3 py-2 rounded-full hover:bg-red-700 flex focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <p>Eliminar</p>
                                        </button>
                                    @endif

                                </div>

                            </td>
                        @endif
                    </tr>

                @endforeach

            </tbody>

            <tfoot class="border-b border-gray-300 bg-gray-50">
                <tr>
                    <td colspan="10" class="py-2 px-5">
                        {{ $products->links()}}
                    </td>
                </tr>
            </tfoot>

        </table>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

    <x-jet-dialog-modal wire:model="modal">

        <x-slot name="title">
            Nuevo Producto
        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">
                    <div>
                        <Label>Nombre</Label>
                    </div>
                    <div>
                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="name">
                    </div>
                    <div>
                        @error('name') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex-auto ">
                    <div>
                        <Label>Categoría</Label>
                    </div>
                    <div>

                        <select wire:model.defer="category_id" class="bg-white rounded text-sm w-full">

                            <option value="">Seleccione una categoría</option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @endforeach

                        </select>
                    </div>
                    <div>
                        @error('category_id') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex-auto ">
                    <div>
                        <Label>Stock</Label>
                    </div>
                    <div>
                        <div class="relative rounded-md shadow-sm">
                            <input type="number" class="bg-white rounded text-sm w-full @if($stock == -1) hidden @endif" wire:model="stock" @if($stock == -1) readonly @endif min="-1">
                            <div class="@if($stock != -1) absolute @endif inset-y-0 right-0 flex items-center">
                                <select id="selectType" class="@if($stock == -1) w-full py-2 border-gray-500 @endif focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                    <option value="unidades" @if($stock != -1) selected @endif>Unidades</option>
                                    <option value="alimento" @if($stock == -1) selected @endif>Alimento</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div>
                        @error('stock') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">
                    <div>
                        <Label>Precio de compra</Label>
                    </div>
                    <div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">
                                $
                                </span>
                            </div>
                            <input type="number" class="bg-white rounded text-sm w-full pl-7 " wire:model.defer="purchase_price" placeholder="0.00">
                        </div>
                    </div>
                    <div>
                        @error('purchase_price') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex-auto ">
                    <div>
                        <Label>Precio de venta</Label>
                    </div>
                    <div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">
                                $
                                </span>
                            </div>
                            <input type="number" class="bg-white rounded text-sm w-full pl-7 " wire:model.defer="sale_price" placeholder="0.00">
                        </div>
                    </div>
                    <div>
                        @error('sale_price') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-4">

                <div class="flex-auto ">
                    <div>
                        <Label>Descripción</Label>
                    </div>
                    <div>
                        <textarea rows="2" class="bg-white rounded text-sm w-full" wire:model.defer="description"></textarea>
                    </div>
                    <div>
                        @error('description') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            @if($stock == -1)
                <div class="md:space-x-3 mb-5 " id="extras_block">

                    <div class="mb-2">
                        <Label>Extras</Label>
                    </div>

                    <div class="flex flex-wrap overflow-y-auto max-h-60">
                        @foreach($extras as $extra)

                            <label class="border border-gray-500 px-2 rounded-full py-1 mr-2 mb-1 text-sm cursor-pointer">
                                <input class="bg-white rounded" type="checkbox" wire:model.defer="selected_extras" value="{{ $extra->id }}">
                                {{ $extra->name }}
                            </label>

                        @endforeach
                    </div>

                </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div x-data="{photoName: null}"  class="flex-auto ">

                    <button type="button" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none"
                            x-on:click="$refs.photo.click()"
                    >
                        Selecciona la imágen del producto
                    </button>

                    <input type="file" class="hidden" wire:model="image" x-ref="photo">

                    <div class="mt-2">

                        @if($image)

                            <img class="rounded h-40  object-cover" src="{{ $image->temporaryUrl() }}" alt="Imagen del producto">

                        @else

                            @if (!$image && isset($image_url))

                                <img class="rounded h-40 object-cover" src="/storage/{{ $image_url }}" class="w-50 p-4">

                            @else

                                <img class="rounded h-40 object-cover" src="{{ asset('storage/img/icono.png') }}" alt="Imagen del producto">

                            @endif

                        @endif

                    </div>

                    @error('image') <span class="block font-medium text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="float-righ">

                @if($create)

                    <button
                        wire:click="create"
                        wire:loading.attr="disabled"
                        wire:target="create, image"
                        class="disabled:opacity-25 bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">
                        Guardar
                    </button>

                @endif

                @if($edit)

                    <button
                        wire:click="update"
                        wire:loading.attr="disabled"
                        wire:target="update, image"
                        class="disabled:opacity-25 bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">
                        Actualizar
                    </button>

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
            Eliminar Cliente
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar el producto?, No sera posible recuperar la información.
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

        document.getElementById('selectType').addEventListener('change', ()=>{
            if(document.getElementById('selectType').value == 'alimento'){
                @this.set('stock', -1);
            }else{
                document.getElementById('selectType').value = "Unidades";
                @this.set('stock', null);
            }
        })

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
