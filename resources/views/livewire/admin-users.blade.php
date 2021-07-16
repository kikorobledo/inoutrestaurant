<div class="">

    <div class="mb-5">

        {{-- <div
            class="flex justify-between mb-5"
            x-data="{show:false}"
            x-init="@this.on('showMessage', () => { show=true, setTimeout( () => {show=false;}, 4000 ) })"
        >

            <h1 class="titulo-seccion text-3xl font-thin text-gray-500">Usuarios</h1>

            <span
                class="bg-green-500 py-2 px-4 text-white text-md rounded-full float-right"
                x-show.transition.opacity.out.duration.1500ms="show"
            >
                {{ $message }}
            </span>

        </div> --}}

        <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-5">Usuarios</h1>

        <div>

            <input type="text" wire:model="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

            <button wire:click="openModalCreate" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none hidden md:block">Agregar Nuevo Usuario</button>

            <button wire:click="openModalCreate" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none md:hidden">+</button>

        </div>

    </div>

    @if($users->count())

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
                    <th wire:click="order('email')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Correo
                        @if($sort == 'email')
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
                    <th wire:click="order('role')" class="cursor-pointer px-6 py-3 hidden lg:table-cell">
                        Rol
                        @if($sort == 'role')
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

            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                @foreach($users as $user)

                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">#</span>
                            {{ $user->user_number }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>
                            <div class="flex items-center justify-center lg:justify-start">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Email</span>
                            {{ $user->email }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Role</span>
                            {{ $user->role_name }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Status</span>
                            @if($user->status == 'activo')
                                <span class="bg-green-400 py-1 px-2 rounded-full text-white">{{ ucfirst($user->status) }}</span>
                            @else
                                <span class="bg-red-400 py-1 px-2 rounded-full text-white">{{ ucfirst($user->status) }}</span>
                            @endif

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>
                            @if($user->created_by != null)
                                <span class="font-semibold">Registrado por: {{$user->createdBy->name}}</span> <br>
                            @endif
                            {{ $user->created_at }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>
                            @if($user->updated_by != null)
                                <span class="font-semibold">Actualizado por: {{$user->updatedBy->name}}</span> <br>
                            @endif
                            {{ $user->updated_at }}

                        </td>
                        <td class="px-6 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                            <div class="flex justify-center lg:justify-start">

                                <button wire:click="openModalEdit({{$user}})" class="bg-blue-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-blue-700 flex focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <p>Editar</p>
                                </button>

                                <button wire:click="openModalDelete({{$user}})" class="bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full hover:bg-red-700 flex focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <p>Eliminar</p>
                                </button>

                            </div>

                        </td>
                    </tr>

                @endforeach

            </tbody>

            <tfoot class="border-b border-gray-300 bg-gray-50">
                <tr>
                    <td colspan="8" class="py-2 px-5">
                        {{ $users->links()}}
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
            Nuevo Usuario
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
                        <Label>Email</Label>
                    </div>
                    <div>
                        <input type="email" class="bg-white rounded text-sm w-full" wire:model.defer="email">
                    </div>
                    <div>
                        @error('email') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto mr-1 ">
                    <div>
                        <Label>Status</Label>
                    </div>
                    <div>
                        <select class="bg-white rounded text-sm w-full" wire:model.defer="status">
                            <option value="">Seleccione una opción</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div>
                        @error('status') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex-auto mr-1 ">
                    <div>
                        <Label>Role</Label>
                    </div>
                    <div>
                        <select class="bg-white rounded text-sm w-full" wire:model.defer="role">
                            <option value="">Seleccione una opción</option>
                            <option value="2">Administrador Tienda</option>
                            <option value="3">Empleado</option>
                            <option value="4">Empleado Especial</option>
                        </select>
                    </div>
                    <div>
                        @error('role') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
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
            Eliminar Usuario
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar al usuario?, No sera posible recuperar la información.
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
