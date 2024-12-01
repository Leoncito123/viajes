
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- drawer init and toggle -->
<div>
    <!-- Botón para abrir el drawer -->
    <button class="text-white bg-indigo-500 p-2 rounded-lg" type="button" data-drawer-show="drawer-example">
        Gestión del Vuelo
    </button>

    <!-- drawer component -->
    <div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-full lg:w-11/12 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
        <div class="flex justify-end text-center mb-4">  <!-- Cambié aquí para usar flex -->
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-2 text-center" data-modal-hide="drawer-example">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const drawer = document.getElementById('drawer-example');
        const closeButton = document.querySelector('[data-modal-hide="drawer-example"]');

        document.querySelector('[data-drawer-show="drawer-example"]').addEventListener('click', function () {
            drawer.classList.remove('-translate-x-full');
        });

        closeButton.addEventListener('click', function () {
            drawer.classList.add('-translate-x-full');
        });
    });
</script>
    <div class="p-4">
        <p class="text-2xl font-semibold">Gestión de Vuelos</p>
    </div>
    <div class="p-4">
        <div class="grid md:grid-cols-2 gap-8">
            <div class="border border-indigo-500 rounded-lg p-4">
                <div class="">
                    <p class="text-lg font-semibold">Gestion de Aerolineas</p>
                </div>

                <div class="flex py-2">
                    @include('vuelos.admiVuelosComponents.createAerolinea')
                </div>
                <div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ubicación
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($airlines as $airline)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$airline->name}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$airline->ubication}}
                                    </th>
                                    <td class="px-6 py-4">
                                        <!-- Dropdown -->
                                        <div class="relative">
                                            <button id="dropdownButton-{{ $airline->id }}"
                                                    data-dropdown-toggle="dropdown-{{ $airline->id }}"
                                                    class="text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                                    type="button">
                                                Crear Aerolínea
                                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="dropdown-{{ $airline->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-1/2 dark:bg-gray-700 absolute">
                                                <form action="{{ route('airline.update', $airline->id) }}" method="POST" class="py-6">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4 w-full px-4">
                                                        <label for="name-{{ $airline->id }}" class="text-md">Nombre de la aerolínea</label>
                                                        <div>
                                                            <input type="text" name="name" id="name-{{ $airline->id }}" value="{{ old('name', $airline->name) }}" class="w-full rounded-lg border-indigo-500">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 w-full px-4">
                                                        <label for="ubication-{{ $airline->id }}" class="text-md">Ubicación</label>
                                                        <div>
                                                            <input type="text" name="ubication" id="ubication-{{ $airline->id }}" value="{{ old('ubication', $airline->ubication) }}" class="w-full rounded-lg border-indigo-500">
                                                        </div>
                                                    </div>
                                                    <div class="px-4">
                                                        <button type="submit" class="p-2 bg-indigo-500 dark:bg-blue-500 text-white rounded-lg">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                    </td>
                                </tr>
                                @endforeach

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        // Seleccionar todos los botones y dropdowns
                                        const dropdownButtons = document.querySelectorAll("[data-dropdown-toggle]");

                                        dropdownButtons.forEach(button => {
                                            button.addEventListener("click", function () {
                                                const dropdownId = button.getAttribute("data-dropdown-toggle");
                                                const dropdown = document.getElementById(dropdownId);

                                                // Alternar visibilidad del dropdown
                                                if (dropdown.classList.contains("hidden")) {
                                                    dropdown.classList.remove("hidden");
                                                } else {
                                                    dropdown.classList.add("hidden");
                                                }
                                            });
                                        });

                                        // Cerrar dropdown si se hace clic fuera
                                        document.addEventListener("click", function (event) {
                                            dropdownButtons.forEach(button => {
                                                const dropdownId = button.getAttribute("data-dropdown-toggle");
                                                const dropdown = document.getElementById(dropdownId);

                                                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                                                    dropdown.classList.add("hidden");
                                                }
                                            });
                                        });
                                    });
                                </script>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="border border-indigo-500 rounded-lg p-4">
                <div class="">
                    <p class="text-lg font-semibold">Gestion de Clases</p>
                </div>

                <div class="flex py-2">
                    @include('vuelos.admiVuelosComponents.createClass')
                </div>
                <div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $class)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$class->type}}
                                    </th>
                                    <td class="px-6 py-4">
                                        <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                        <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="border border-indigo-500 rounded-lg p-4">
                <div class="">
                    <p class="text-lg font-semibold">Gestion de Edades</p>
                </div>
                <div class="flex py-2">
                    @include('vuelos.admiVuelosComponents.createAges')
                </div>
                <div>
                    <div class="relative overflow-x-auto">

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edad Maxima
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edad Minima
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ages as $age)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$age->name}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$age->max_number}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$age->min_number}}
                                    </th>
                                    <td class="px-6 py-4">
                                        <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                        <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="border border-indigo-500 rounded-lg p-4">
                <div class="">
                    <p class="text-lg font-semibold">Gestion de Destinos</p>
                </div>

                <div class="flex py-2">
                    @include('vuelos.admiVuelosComponents.createDestiny')

                </div>
                <div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Acciones
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ver Info
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        California
                                    </th>
                                    <td class="px-6 py-4">
                                        <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                        <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a class="border-b-2" href="">Ver Información</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Monterrey, Nuevo Leon
                                    </th>
                                    <td class="px-6 py-4">
                                        <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                        <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a class="border-b-2" href="">Ver Información</a>
                                    </td>
                                </tr>

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        La Paz, Baja California
                                    </th>
                                    <td class="px-6 py-4">
                                        <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                        <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a class="border-b-2" href="">Ver Información</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


<div class="grid md:grid-cols-2 gap-8">

    <div class="border border-indigo-500 mt-6 rounded-lg p-4">
        <div class="">
            <p class="text-lg font-semibold">Gestion de Aviones</p>
        </div>

        <div class="flex py-2">
            @include('vuelos.admiVuelosComponents.createAirplane')
        </div>
        <div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aerolinea
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad de asientos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Asignar Asientos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    {{-- @php
                        dd($airplanes);
                    @endphp --}}
                    <tbody>
                        @foreach ($airplanes as $airplane)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$airplane->name}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$airplane->airline->name}}
                                </td>
                                    <td class="px-6 py-4">
                                        @foreach($airplane->seats as $seat)
                                            {{$seat->name}}
                                        @endforeach
                                    </td>
                                <td class="px-6 py-4">
                                    @include('vuelos.admiVuelosComponents.createSeats')
                                </td>
                                <td class="px-6 py-4">
                                    <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                    <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="mt-4 w-full ">
        <div class="border border-indigo-500 rounded-lg">
            <div class="p-4">
                <div>
                    <p class="text-lg font-semibold">Gestion de Escalas</p>
                </div>
                <div>

                <div class="flex mt-2">
                    {{-- <!-- Modal toggle -->
                    <button data-modal-target="default-modal3" data-modal-toggle="default-modal3" class=" block text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Crear Escala
                    </button> --}}


        <div class="flex py-2">
            <button class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
        </div>

                    <!-- Main modal -->
                    <div id="default-modal3" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="p-4 border-b-2 border-indigo-500">
                                   <p class="font-semibold text-xl"> Crear Escala</p>
                                </div>
                                <form action="" class="p-4 w-full">
                                    <div class="mb-4">
                                        <label for="" class="text-md">Escala</label>
                                        <input type="text" class="w-full rounded-lg border-indigo-500">
                                    </div>
                                    <div>
                                        <button type="submit" class="p-2 bg-indigo-500 dark:bg-blue-500 text-white rounded-lg">Crear Escala</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
                <div>
                    <table class="w-full mt-4 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Escala
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
                                <td class="px-6 py-4">
                                    <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                    <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Avion 1
                                </th>
                                <td class="px-6 py-4">
                                    <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                    <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                </td>
                            </tr>

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Avion 1
                                </th>
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
