
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
                                        <form action="{{route('airline.delete', ['id_airline'=>$airline->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                        </form>
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
                                        <form action="{{route('delete.class', ['id_class'=>$class->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                        </form>
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
                                        <form action="{{route('age.delete', ['id_age'=>$age->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                        </form>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($destinies as $destiny)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$destiny->name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        <form action="{{route('destiny.delete', ['id_destiny'=>$destiny->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
    </div>
</div>
