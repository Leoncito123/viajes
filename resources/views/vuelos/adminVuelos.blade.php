@extends('vistasLeo.Admin.index')
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
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
            @if (session('error'))
                <script>
                    Swal.fire({
                        title: "¡Error!",
                        text: "¡Ha ocurrido un error!",
                        icon: "error"
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
                                        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                                            class=" block text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            type="button">
                                            Crear Vuelo
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <div class="p-4 border-b-2 border-indigo-500">
                                                        <p class="font-semibold text-xl"> Crear Vuelo</p>
                                                    </div>
                                                    <form action="{{ route('vuelo.store') }}" method="POST"
                                                        class="p-4 w-full dark:text-black">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label for="id_airplane" class="text-md">Avion</label>
                                                            <select name="id_airplane" id="id_airplane"
                                                                class="w-full rounded-lg border-indigo-500" id="">
                                                                @foreach ($airplanes as $airplane)
                                                                    <option value="{{ $airplane->id }}">
                                                                        {{ $airplane->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="id_destiny" class="text-md">Destino</label>
                                                            <select name="id_destiny" id="id_destiny"
                                                                class="w-full rounded-lg border-indigo-500" id="">
                                                                @foreach ($destinies as $destiny)
                                                                    <option value="{{ $destiny->id }}">{{ $destiny->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="depature_date" class="text-md">Fecha de
                                                                salida</label>
                                                            <input type="date" name="depature_date" id="depature_date"
                                                                class="w-full rounded-lg border-indigo-500">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="arrival_date" class="text-md">Fecha de
                                                                Llegada</label>
                                                            <input type="date" name="arrival_date" id="arrival_date"
                                                                class="w-full rounded-lg border-indigo-500">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="fly_number" class="text-md">Numero de Vuelo</label>
                                                            <input type="text" name="fly_number" id="fly_number"
                                                                class="w-full rounded-lg border-indigo-500">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="fly_duration" class="text-md">Duración del
                                                                Vuelo</label>
                                                            <input type="text" name="fly_duration" id="fly_duration"
                                                                class="w-full rounded-lg border-indigo-500">
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="costs" class="text-md block mb-2">Asignar costos
                                                                por clase</label>
                                                            <div id="cost-class-container">
                                                                <div class="flex items-center gap-2 mb-2">
                                                                    <input type="number" name="costs[]"
                                                                        class="w-1/2 rounded-lg border-indigo-500"
                                                                        placeholder="Costo" required>
                                                                    <select name="classes[]"
                                                                        class="w-1/2 rounded-lg border-indigo-500" required>
                                                                        @foreach ($classes as $class)
                                                                            <option value="{{ $class->id }}">
                                                                                {{ $class->type }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <button type="button"
                                                                        class="bg-green-500 text-white px-4 py-2 rounded-lg"
                                                                        id="addInputCost">Añadir</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4" id="dynamicScalesContainer">
                                                            <label for="scales" class="text-md">Asignar escalas</label>
                                                            <div class="flex items-center gap-2 mb-2">
                                                                <select name="scales[]"
                                                                    class="w-full rounded-lg border-indigo-500" required>
                                                                    @foreach ($destinies as $destiny)
                                                                        <option value="{{ $destiny->id }}">
                                                                            {{ $destiny->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <button type="button"
                                                                    class="bg-green-500 text-white p-2 rounded-lg"
                                                                    id="addScale">Añadir</button>
                                                            </div>
                                                        </div>


                                                        <div>
                                                            <button type="submit"
                                                                class="p-2 bg-indigo-500 dark:bg-blue-500 text-white rounded-lg">Crear
                                                                Vuelo</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="relative overflow-x-auto">
                                            <table
                                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <thead
                                                    class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
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
                                                            Costo por clase del vuelo
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
                                                    @foreach ($flies as $fly)
                                                        <tr
                                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $fly->airplane->name }}
                                                            </th>
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $fly->destiny->name }}
                                                            </th>
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $fly->depature_date }}
                                                            </th>
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $fly->arrival_date }}
                                                            </th>
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $fly->fly_number }}
                                                            </th>
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $fly->fly_duration }}
                                                            </th>
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                @foreach ($fly->flycosts as $cost)
                                                                    {{ $cost->classe->type }}: ${{ $cost->cost }} <br>
                                                                @endforeach
                                                            </th>
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $fly->scales->count() }}
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                <a href="{{ route('edit.vuelo', $fly->id) }}"
                                                                    class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</a>
                                                                <button onclick="deleteFly({{ $fly->id }})"
                                                                    class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
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
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addInputCost').addEventListener('click', function() {
            const container = document.getElementById('cost-class-container');

            const row = document.createElement('div');
            row.className = 'flex items-center gap-2 mb-2';

            //input para costo
            const costInput = document.createElement('input');
            costInput.type = 'number';
            costInput.name = 'costs[]';
            costInput.className = 'w-1/2 rounded-lg border-indigo-500';
            costInput.placeholder = 'Costo';
            costInput.required = true;

            //select para clase
            const classSelect = document.createElement('select');
            classSelect.name = 'classes[]';
            classSelect.className = 'w-1/2 rounded-lg border-indigo-500';
            classSelect.required = true;

            @foreach ($classes as $class)
                const option{{ $class->id }} = document.createElement('option');
                option{{ $class->id }}.value = '{{ $class->id }}';
                option{{ $class->id }}.textContent = '{{ $class->type }}';
                classSelect.appendChild(option{{ $class->id }});
            @endforeach

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'bg-red-500 text-white px-4 py-2 rounded-lg';
            removeButton.textContent = 'Eliminar';

            removeButton.addEventListener('click', function() {
                row.remove();
            });

            row.appendChild(costInput);
            row.appendChild(classSelect);
            row.appendChild(removeButton);

            container.appendChild(row);
        });


        //Inicia el script para lo de agregar escalas
        document.addEventListener('DOMContentLoaded', function() {
            const scalesContainer = document.getElementById('dynamicScalesContainer');
            const addScaleButton = document.getElementById('addScale');

            addScaleButton.addEventListener('click', function() {
                const newScaleRow = document.createElement('div');
                newScaleRow.classList.add('flex', 'items-center', 'gap-2', 'mb-2');

                newScaleRow.innerHTML = `
                <select name="scales[]" class="w-full rounded-lg border-indigo-500" required>
                    @foreach ($destinies as $destiny)
                        <option value="{{ $destiny->id }}">{{ $destiny->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="bg-red-500 text-white p-2 rounded-lg removeScale">Eliminar</button>
            `;

                scalesContainer.appendChild(newScaleRow);

                // aqui seria el eliminar
                newScaleRow.querySelector('.removeScale').addEventListener('click', function() {
                    scalesContainer.removeChild(newScaleRow);
                });
            });
        });

        function deleteFly(id) {
            Swal.fire({
                title: '¿Estás seguro de eliminar el vuelo?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                fetch(`/deleteFly/${id}`,{
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(() => {
                    location.reload();
                });
            });
        }
    </script>
@endsection
