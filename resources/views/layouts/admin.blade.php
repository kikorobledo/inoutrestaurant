<x-app-layout>

    <div class="flex flex-row h-screen transition duration-500 ease-in-out" x-data={open_side_menu:true}>

        {{-- Menu --}}
        <div class="w-72 flex flex-col bg-white sm:block" x-show.transition.in.duration.1000ms.out.duration.350ms="open_side_menu">

            {{-- Header --}}
            <div class="w-100 flex-none bg-white border-b-2 border-b-grey-200 flex flex-row p-5 pr-0 justify-between items-center h-20">

                {{-- Logo --}}
                <a href="{{ route('admin.index')}}" class="flex">

                    <img class="h-8 w-8 " src="{{ asset('storage/img/icono.png') }}" alt="Logo">

                    <span class="text-semibold text-2xl ml-3">InOut</span>

                </a>

                {{-- Side Menu hide button --}}
                <button x-show="open_side_menu" x-on:click="open_side_menu=false" type="button" title="Cerrar Menú" class="sm:hidden inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

            {{-- Side Menu --}}
            <div class="flex-auto overflow-y-auto">

                <div class="p-4 text-gray-500">

                    <p class="uppercase text-md text-gray-600 mb-4 tracking-wider">Administración</p>

                    @if(auth()->user()->role == 1 || auth()->user()->role == 2 )

                        <a href="{{ route('admin.users.index') }}" class="mb-3 capitalize font-medium text-md hover:text-teal-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-4 ">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>

                            Usuarios
                        </a>

                        <a href="{{ route('admin.categories.index') }}" class="mb-3 capitalize font-medium text-md hover:text-teal-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>

                            Categorías
                        </a>

                    @endif

                </div>

            </div>

        </div>

        {{-- Main Content --}}
        <div class="flex-auto flex-col flex">

            {{-- Header --}}
            <div class="w-100  bg-white border-b-2 border-b-grey-200 flex-none flex flex-row p-5 justify-between items-center h-20">

                <!-- Mobile menu button-->
                <div class="flex items-center">

                    <button x-show.transition.in.duration.1000ms.out.duration.200ms="!open_side_menu" x-on:click="open_side_menu=true" type="button" title="Abrir Menú" class=" inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                    </button>

                </div>

                {{-- Logo --}}
                <img x-show.transition.in.duration.1000ms.out.duration.200msw="!open_side_menu"  class="h-8 w-8 " src="{{ asset('storage/img/icono.png') }}" alt="Logo">

                <!-- Profile dropdown -->
                <div class="ml-3 relative" x-data="{ open_drop_down:false }">

                    <div>

                        <button x-on:click="open_drop_down=true" type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-expanded="false" aria-haspopup="true">

                            <span class="sr-only">Abrir menú de usuario</span>

                            <img class="h-10 w-10 rounded-full" src="{{Auth::user()->profile_photo_url}}" alt="{{ Auth::user()->name }}" id="nav-profile">

                        </button>

                    </div>

                    <!--
                        Dropdown menu, show/hide based on menu state.

                        Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                        Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div x-show="open_drop_down" x-on:click.away="open_drop_down=false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mi Perfil</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none" role="menuitem">Sign out</button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- Contenido --}}
            <div class="bg-gray-100 p-8 flex-auto overflow-y-auto border-l-2 border-l-grey-200 ">
                @yield('content')
            </div>

        </div>

    </div>

    <script>

        /* Change nav profile image */
        window.addEventListener('nav-profile-img', event => {

            document.getElementById('nav-profile').setAttribute('src', event.detail.img);

        });

    </script>

</x-app-layout>
