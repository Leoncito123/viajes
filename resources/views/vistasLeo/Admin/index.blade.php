<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('components.leo.admin.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white border-b dark:border-gray-700 border-indigo-400 dark:bg-gray-800 shadow">
                <div class="max-w-10xl  py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
                {{-- Boton modo oscuro --}}
                <button id="theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </header>
        @endisset

        <!-- Page Content -->
        <main>

            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
                aria-controls="default-sidebar" type="button"
                class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>
            <div class="py-4  lg:mr-4 px-8">
                <div
                    class=" dark:border-gray-700 border border-indigo-400 border-lg rounded-lg bg-blue-500 p-6 flex items-center">
                    <svg class="w-8 h-8 border-2 rounded-full p-1 border-indigo-500 text-indigo-600 font-semibold dark:text-white dark:border-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                    </svg>
                    <p class="font-semibold ml-2 text-black dark:text-white">Turistas Sin Maps</p>
                </div>
            </div>

            <div class="lg:mr-4 px-8 ">
                <div class=" dark:border-gray-700 border border-indigo-400 border-lg rounded-lg">
                    {{-- <x-leo.admin.sidebar /> --}}
                    @yield('content')
                    <div>
                        <div class="py-">
                            <div class="max-w-8xl ">
                                @if (session('nuevoVuelo'))
                                    <script>
                                        Swal.fire({
                                            title: "Registo Completado!",
                                            text: "¡El vuelo a sido registrado!",
                                            icon: "success"
                                        });
                                    </script>
                                @endif
                                @if (session('costo'))
                                    <script>
                                        Swal.fire({
                                            title: "¡Costo Asignado!",
                                            text: "¡Se ha asignado el costo al vuelo!",
                                            icon: "success"
                                        });
                                    </script>
                                @endif
                                <div class="bg-white  dark:bg-gray-800 shadow-sm sm:rounded-lg">
                                    <div class=" py-4  w-full text-gray-900 dark:text-gray-100">
                                        <div class="px-4">
                                            <div>
                                                @include('layouts.gestionVuelo')
                                            </div>
                                            <div>

                                                <div class="mt-6">
                                                    <div class="border border-indigo-500 rounded-lg p-4">
                                                        <div class="">
                                                            <p class="text-lg font-semibold">Gestion de Vuelos</p>
                                                        </div>
                                                        <div class="flex mt-2">
                                                            <!-- Modal toggle -->
                                                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class=" block text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                                Crear Vuelo
                                                            </button>

                                                            <!-- Main modal -->
                                                            <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                        <div class="p-4 border-b-2 border-indigo-500">
                                                                           <p class="font-semibold text-xl"> Crear Vuelo</p>
                                                                        </div>
                                                                        <form action="{{route('vuelo.store')}}" method="POST" class="p-4 w-full">
                                                                            @csrf
                                                                            <div class="mb-4">
                                                                                <label for="avion" class="text-md">Avion</label>
                                                                                <select name="avion" id="avion" class="w-full rounded-lg border-indigo-500" id="">
                                                                                    <option value="1">Avion 1</option>
                                                                                    <option value="2">Avion 2</option>
                                                                                    <option value="3">Avion 3</option>
                                                                                </select>
                                                                            </div>
                                                                           <div class="mb-4">
                                                                                <label for="destino" class="text-md">Destino</label>
                                                                                <select name="destino" id="destino" class="w-full rounded-lg border-indigo-500" id="">
                                                                                    <option value="1">Monterrey</option>
                                                                                    <option value="2">Guadalajara</option>
                                                                                    <option value="3">CD. de México</option>
                                                                                </select>
                                                                           </div>
                                                                            <div class="mb-4">
                                                                                <label for="salida" class="text-md">Fecha de salida</label>
                                                                                <input type="text" name="salida" id="salida" class="w-full rounded-lg border-indigo-500">
                                                                            </div>
                                                                            <div class="mb-4">
                                                                                <label for="llegada" class="text-md">Fecha de Llegada</label>
                                                                                <input type="text" name="llegada" id="llegada" class="w-full rounded-lg border-indigo-500">
                                                                            </div>
                                                                            <div class="mb-4">
                                                                                <label for="NumVuelo" class="text-md">Numero de Vuelo</label>
                                                                                <input type="text" name="NumVuelo" id="NumVuelo" class="w-full rounded-lg border-indigo-500">
                                                                            </div>
                                                                            <div class="mb-4">
                                                                                <label for="tiempoVuelo" class="text-md">Duración del Vuelo</label>
                                                                                <input type="text" name="tiempoVuelo" id="tiempoVuelo" class="w-full rounded-lg border-indigo-500">
                                                                            </div>
                                                                            <div>
                                                                                <button type="submit" class="p-2 bg-indigo-500 dark:bg-blue-500 text-white rounded-lg">Crear Vuelo</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="mt-4">
                                                            <div class="relative overflow-x-auto">
                                                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                                                                        <tr>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Avion
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Destino
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Fecha de Salida
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Fecha de LLegada
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                No. de Vuelo
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Duración del Vuelo
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Costo Del Vuelo
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Escalas
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Acciones
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                Avion 1
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                La Paz, Baja California
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                05/06/2024
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                05/06/2024
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                12354
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                2:00 hrs
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                @include('layouts.vuelos.costoModal')
                                                                            </th>
                                                                            <td class="px-6 py-4">
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Asignar</button>
                                                                            </td>
                                                                            <td class="px-6 py-4">
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                Avion 1
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                La Paz, Baja California
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                05/06/2024
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                05/06/2024
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                12354
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                2:00 hrs
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                @include('layouts.vuelos.costoModal')
                                                                            </th>
                                                                            <td class="px-6 py-4">
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Asignar</button>
                                                                            </td>
                                                                            <td class="px-6 py-4">
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                                                            </td>
                                                                        </tr>

                                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                Avion 1
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                La Paz, Baja California
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                05/06/2024
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                05/06/2024
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                12354
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                2:00 hrs
                                                                            </th>
                                                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                @include('layouts.vuelos.costoModal')
                                                                            </th>
                                                                            <td class="px-6 py-4">
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Asignar</button>
                                                                            </td>
                                                                            <td class="px-6 py-4">
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                                                                <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>

</html>
