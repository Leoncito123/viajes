

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
                    <button class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
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
                                        Viva Aerobus
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
                                        Aeromexico
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
                                        Volaris
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
            <div class="border border-indigo-500 rounded-lg p-4">
                <div class="">
                    <p class="text-lg font-semibold">Gestion de Clases</p>
                </div>

                <div class="flex py-2">
                    <button class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
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
                                        VIP
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
                                        Ejecutivo
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
                                        Normal
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
            <div class="border border-indigo-500 rounded-lg p-4">
                <div class="">
                    <p class="text-lg font-semibold">Gestion de Edades</p>
                </div>
                <div class="flex py-2">
                    <button class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
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
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Infante
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        0
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        12
                                    </th>
                                    <td class="px-6 py-4">
                                        <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                        <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Adulto
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        12
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        50
                                    </th>
                                    <td class="px-6 py-4">
                                        <button class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                        <button class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                    </td>
                                </tr>

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Tercera Edad
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        50
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        100
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
            <div class="border border-indigo-500 rounded-lg p-4">
                <div class="">
                    <p class="text-lg font-semibold">Gestion de Destinos</p>
                </div>

                <div class="flex py-2">
                    <button class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
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
            <button class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
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
                                Avion 1
                            </th>
                            <td class="px-6 py-4">
                                <a class="border-b-2" href="">Viva aerobus</a>
                            </td>
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
                                Avion 2
                            </th>
                            <td class="px-6 py-4">
                                <a class="border-b-2" href="">Viva aerobus</a>
                            </td>
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
                                Avion 3
                            </th>
                            <td class="px-6 py-4">
                                <a class="border-b-2" href="">Viva aerobus</a>
                            </td>
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
