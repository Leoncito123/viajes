@extends('vistasLeo.Admin.index')
@section('title', 'Editar Vuelo')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="py-4 w-full text-gray-900 dark:text-gray-100">
            <div class="px-4">
                <div>
                    @include('layouts.gestionVuelo')
                </div>

                <div class="mt-6">
                    <div class="border border-indigo-500 rounded-lg p-4">
                        <div>
                            <p class="text-lg font-semibold">Editar Vuelo</p>
                        </div>

                        <div class="mt-4">
                            <form action="" method="POST" class="p-4 w-full dark:text-black">
                                @csrf
                                <div class="mb-4">
                                    <label for="id_airplane" class="text-md">Avión</label>
                                    <select name="id_airplane" id="id_airplane" class="w-full rounded-lg border-indigo-500">
                                        @foreach ($airplanes as $airplane)
                                            <option value="{{ $airplane->id }}">{{ $airplane->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="id_destiny" class="text-md">Destino</label>
                                    <select name="id_destiny" id="id_destiny" class="w-full rounded-lg border-indigo-500">
                                        @foreach ($destinies as $destiny)
                                            <option value="{{ $destiny->id }}">{{ $destiny->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="depature_date" class="text-md">Fecha de salida</label>
                                    <input type="date" name="depature_date" id="depature_date" class="w-full rounded-lg border-indigo-500">
                                </div>

                                <div class="mb-4">
                                    <label for="arrival_date" class="text-md">Fecha de llegada</label>
                                    <input type="date" name="arrival_date" id="arrival_date" class="w-full rounded-lg border-indigo-500">
                                </div>

                                <div class="mb-4">
                                    <label for="fly_number" class="text-md">Número de Vuelo</label>
                                    <input type="text" name="fly_number" id="fly_number" class="w-full rounded-lg border-indigo-500">
                                </div>

                                <div class="mb-4">
                                    <label for="fly_duration" class="text-md">Duración del Vuelo</label>
                                    <input type="text" name="fly_duration" id="fly_duration" class="w-full rounded-lg border-indigo-500">
                                </div>

                                <div class="mb-4">
                                    <label for="costs" class="text-md block mb-2">Asignar costos por clase</label>
                                    <div id="cost-class-container">
                                        <div class="flex items-center gap-2 mb-2">
                                            <input type="number" name="costs[]" class="w-1/2 rounded-lg border-indigo-500" placeholder="Costo" required>
                                            <select name="classes[]" class="w-1/2 rounded-lg border-indigo-500" required>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->type }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-lg" id="addInputCost">Añadir</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4" id="dynamicScalesContainer">
                                    <label for="scales" class="text-md">Asignar escalas</label>
                                    <div class="flex items-center gap-2 mb-2">
                                        <select name="scales[]" class="w-full rounded-lg border-indigo-500" required>
                                            @foreach ($destinies as $destiny)
                                                <option value="{{ $destiny->id }}">{{ $destiny->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="bg-green-500 text-white p-2 rounded-lg" id="addScale">Añadir</button>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-lg">Guardar Vuelo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Código para gestionar costos dinámicos
        document.getElementById('addInputCost').addEventListener('click', function () {
            const container = document.getElementById('cost-class-container');
            const row = document.createElement('div');
            row.className = 'flex items-center gap-2 mb-2';

            const costInput = document.createElement('input');
            costInput.type = 'number';
            costInput.name = 'costs[]';
            costInput.className = 'w-1/2 rounded-lg border-indigo-500';
            costInput.placeholder = 'Costo';
            costInput.required = true;

            const classSelect = document.createElement('select');
            classSelect.name = 'classes[]';
            classSelect.className = 'w-1/2 rounded-lg border-indigo-500';
            classSelect.required = true;

            @foreach ($classes as $class)
                const option = document.createElement('option');
                option.value = '{{ $class->id }}';
                option.textContent = '{{ $class->type }}';
                classSelect.appendChild(option);
            @endforeach

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'bg-red-500 text-white px-4 py-2 rounded-lg';
            removeButton.textContent = 'Eliminar';
            removeButton.addEventListener('click', function () {
                row.remove();
            });

            row.appendChild(costInput);
            row.appendChild(classSelect);
            row.appendChild(removeButton);

            container.appendChild(row);
        });

        // Código para gestionar escalas dinámicas
        document.getElementById('addScale').addEventListener('click', function () {
            const scalesContainer = document.getElementById('dynamicScalesContainer');
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center gap-2 mb-2';

            newRow.innerHTML = `
                <select name="scales[]" class="w-full rounded-lg border-indigo-500" required>
                    @foreach ($destinies as $destiny)
                        <option value="{{ $destiny->id }}">{{ $destiny->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="bg-red-500 text-white p-2 rounded-lg removeScale">Eliminar</button>
            `;

            newRow.querySelector('.removeScale').addEventListener('click', function () {
                newRow.remove();
            });

            scalesContainer.appendChild(newRow);
        });
    </script>
@endsection
