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
                <div class="mt-6">
                    <div class="border border-indigo-500 rounded-lg p-4">
                        <div>
                            <p class="text-lg font-semibold">Editar Vuelo</p>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('update.vuelo', $fly->id) }}" method="POST"
                                class="p-4 w-full dark:text-black">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="id_airplane" class="text-md">Avión</label>
                                    <select name="id_airplane" id="id_airplane" class="w-full rounded-lg border-indigo-500">
                                        @foreach ($airplanes as $airplane)
                                            <option value="{{ $airplane->id }}"
                                                {{ $fly->id_airplane == $airplane->id ? 'selected' : '' }}>
                                                {{ $airplane->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="id_destiny" class="text-md">Destino</label>
                                    <select name="id_destiny" id="id_destiny" class="w-full rounded-lg border-indigo-500">
                                        @foreach ($destinies as $destiny)
                                            <option value="{{ $destiny->id }}"
                                                {{ $fly->id_destiny == $destiny->id ? 'selected' : '' }}>
                                                {{ $destiny->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="depature_date" class="text-md">Fecha de salida</label>
                                    <input type="date" name="depature_date" id="depature_date"
                                        class="w-full rounded-lg border-indigo-500" value="{{ $fly->depature_date }}">
                                </div>

                                <div class="mb-4">
                                    <label for="arrival_date" class="text-md">Fecha de llegada</label>
                                    <input type="date" name="arrival_date" id="arrival_date"
                                        class="w-full rounded-lg border-indigo-500" value="{{ $fly->arrival_date }}">
                                </div>

                                <div class="mb-4">
                                    <label for="fly_number" class="text-md">Número de Vuelo</label>
                                    <input type="text" name="fly_number" id="fly_number"
                                        class="w-full rounded-lg border-indigo-500" value="{{ $fly->fly_number }}">
                                </div>

                                <div class="mb-4">
                                    <label for="fly_duration" class="text-md">Duración del Vuelo</label>
                                    <input type="text" name="fly_duration" id="fly_duration"
                                        class="w-full rounded-lg border-indigo-500" value="{{ $fly->fly_duration }}">
                                </div>

                                <div class="mb-4">
                                    <label for="costs" class="text-md block mb-2">Asignar costos por clase</label>
                                    <div id="cost-class-container">
                                        @foreach ($fly->flycosts as $flycost)
                                            <div class="flex items-center gap-2 mb-2">
                                                <input type="number" name="costs[]"
                                                    class="w-1/2 rounded-lg border-indigo-500" placeholder="Costo"
                                                    value="{{ $flycost->cost }}" required>
                                                <select name="classes[]" class="w-1/2 rounded-lg border-indigo-500"
                                                    required>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}"
                                                            {{ $flycost->id_class == $class->id ? 'selected' : '' }}>
                                                            {{ $class->type }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-lg removeCost">Eliminar</button>
                                            </div>
                                        @endforeach
                                        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-lg"
                                            id="addInputCost">Añadir</button>
                                    </div>
                                </div>

                                <div class="mb-4" id="dynamicScalesContainer">
                                    <label for="scales" class="text-md">Asignar escalas</label>
                                    @foreach ($fly->scales as $scale)
                                        <div class="flex items-center gap-2 mb-2">
                                            <select name="scales[]" class="w-full rounded-lg border-indigo-500" required>
                                                @foreach ($destinies as $destiny)
                                                    <option value="{{ $destiny->id }}"
                                                        {{ $scale->id_destiny == $destiny->id ? 'selected' : '' }}>
                                                        {{ $destiny->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button"
                                                class="bg-red-500 text-white p-2 rounded-lg removeScale">Eliminar</button>
                                        </div>
                                    @endforeach
                                    <button type="button" class="bg-green-500 text-white p-2 rounded-lg"
                                        id="addScale">Añadir</button>
                                </div>

                                <div class="mt-6">
                                    <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-lg">Guardar
                                        Vuelo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Para costos
                const costContainer = document.getElementById('cost-class-container');
                const addCostButton = document.getElementById('addInputCost');
                
                addCostButton.addEventListener('click', function() {
                    const row = document.createElement('div');
                    row.className = 'flex items-center gap-2 mb-2';
                    
                    row.innerHTML = `
                        <input type="number" name="costs[]" class="w-1/2 rounded-lg border-indigo-500" placeholder="Costo" required>
                        <select name="classes[]" class="w-1/2 rounded-lg border-indigo-500" required>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->type }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg removeCost">Eliminar</button>
                    `;
                    
                    costContainer.insertBefore(row, addCostButton);
                });

                // Delegación de eventos para eliminar costos
                costContainer.addEventListener('click', function(e) {
                    if (e.target.classList.contains('removeCost')) {
                        e.target.parentElement.remove();
                    }
                });

                // Para escalas
                const scalesContainer = document.getElementById('dynamicScalesContainer');
                const addScaleButton = document.getElementById('addScale');

                addScaleButton.addEventListener('click', function() {
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
                    
                    scalesContainer.insertBefore(newRow, addScaleButton);
                });

                // Delegación de eventos para eliminar escalas
                scalesContainer.addEventListener('click', function(e) {
                    if (e.target.classList.contains('removeScale')) {
                        e.target.parentElement.remove();
                    }
                });
            });
        </script>
    </div>
@endsection