@extends('vistasLeo.Admin.index')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
@endsection
