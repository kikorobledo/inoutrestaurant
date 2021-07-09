<div class="">

    <div class="mb-5">

        <div
            class="flex justify-between mb-5"
            x-data="{show:false}"
            x-init="@this.on('showMessage', () => { show=true, setTimeout( () => {show=false;}, 4000 ) })"
        >

            <h1 class="titulo-seccion text-3xl font-thin text-gray-500">Extras</h1>

            <span
                class="bg-green-500 py-2 px-4 text-white text-md rounded-full float-right"
                x-show.transition.opacity.out.duration.1500ms="show"
            >
                {{ $message }}
            </span>

        </div>

        <div>

            <input type="text" wire:model="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

            <button wire:click="openModalCreate" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none hidden md:block">Agregar Nuevo Extra</button>

            <button wire:click="openModalCreate" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none md:hidden">+</button>

        </div>

    </div>

    @if($extras->count())

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
                    <th wire:click="order('sale_price')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
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
                    <th class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Productos Asociados
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

                @foreach($extras as $extra)

                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">#</span>
                            {{ $extra->extra_number }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>
                            <div class="flex items-center justify-center lg:justify-start">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                    {{ $extra->name }}
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Precio de venta</span>
                            $ {{ $extra->price }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Productos asociados</span>
                            @forelse($extra->products as $product)
                                {{ $product->name }}@if(!$loop->last), @endif
                            @empty
                                No tiene producto asociado
                            @endforelse

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>
                            @if($extra->created_by != null)
                                <span class="font-semibold">Registrado por: {{$extra->createdBy->name}}</span> <br>
                            @endif
                            {{ $extra->created_at }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>
                            @if($extra->updated_by != null)
                                <span class="font-semibold">Actualizado por: {{$extra->updatedBy->name}}</span> <br>
                            @endif
                            {{ $extra->updated_at }}

                        </td>
                        @if(auth()->user()->roles[0]->name != 'Empleado')
                            <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                <div class="flex justify-center lg:justify-start">

                                    <button wire:click="openModalEdit({{$extra}})" class="bg-blue-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-blue-700 flex focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <p>Editar</p>
                                    </button>

                                    @if(auth()->user()->roles[0]->name != 'Empleado Especial')
                                        <button wire:click="openModalDelete({{$extra}})" class="bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full hover:bg-red-700 flex focus:outline-none">
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
                    <td colspan="8" class="py-2 px-5">
                        {{ $extras->links()}}
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
            Nuevo extra
        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">
                    <div>
                        <Label>Nombre</Label>
                    </div>
                    <div>
                        <input type="text" class="mt-1 bg-white rounded text-sm w-full" wire:model="name">
                    </div>
                    <div>
                        @error('name') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex-auto ">
                    <div>
                        <Label>Precio</Label>
                    </div>
                    <div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">
                                $
                                </span>
                            </div>
                            <input type="number" class="bg-white rounded text-sm w-full pl-7 " wire:model="price" placeholder="0.00">
                        </div>
                    </div>
                    <div>
                        @error('purchase_price') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="md:space-x-3 mb-5 " id="extras_block">

                <div class="mb-2">
                    <Label>Asociar Alimentos</Label>
                </div>

                <div class="flex flex-wrap overflow-y-auto max-h-60">
                    @foreach($products as $product)

                        <label class="border border-gray-500 px-2 rounded-full py-1 mr-2 mb-1 text-sm cursor-pointer">
                            <input class="bg-white rounded" type="checkbox" wire:model.defer="selected_products" value="{{ $product->id }}">
                            {{ $product->name }}
                        </label>

                    @endforeach
                </div>

            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="float-righ">

                @if($create)

                    <button
                        wire:click="create"
                        wire:loading.attr="disabled"
                        class="disabled:opacity-25 bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">
                        Guardar
                    </button>

                @endif

                @if($edit)

                    <button
                        wire:click="update"
                        wire:loading.attr="disabled"
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
            Eliminar Extra
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar el extra?, No sera posible recuperar la información.
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
