<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <div class="py-">
        <div class="max-w-8xl ">
            <div class="bg-white  dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 dark:text-gray-100">

                    <div class="mt-4">
                        <p class="text-2xl text-indigo-500 font-semibold">Mostrando vuelos para {{$destiny}} el día: {{$date}}.</span></p>
                    </div>
                    <div class="w-full">
                        <div class="w-full grid md:grid-cols-2 mt-4 gap-8">
                            @foreach ($flies as $fly)
                            @if(isset($cant_pasajeros) && $cant_pasajeros <= $fly->seat_count)
                                <div class="border border-indigo-400 rounded-lg h-auto p-2">
                                    <div class="flex p-4">
                                        <!-- Ícono -->
                                        <div class="items-center flex p-2 border-r border-indigo-400">
                                            <svg class="w-20 h-20 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M12 2a1 1 0 0 1 .932.638l7 18a1 1 0 0 1-1.326 1.281L13 19.517V13a1 1 0 1 0-2 0v6.517l-5.606 2.402a1 1 0 0 1-1.326-1.281l7-18A1 1 0 0 1 12 2Z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>

                                        <!-- Detalles del Vuelo -->
                                        <div class="p-4">
                                            <p>Destino: <span class="font-semibold">{{ $fly->destinies->name ?? 'No especificado' }}</span></p>
                                            <p>Precio: <span class="font-semibold">{{ $fly->price ?? 'N/A' }}</span></p>
                                            <p>Fecha de Salida: <span class="font-semibold">{{ $fly->depature_date ?? 'N/A' }}</span></p>
                                            <p>Fecha de Regreso: <span class="font-semibold">{{ $fly->arrival_date ?? 'N/A' }}</span></p>
                                            <p>Identificador de Vuelo: <span class="font-semibold">{{ $fly->fly_number ?? 'N/A' }}</span></p>
                                            <p>Duración del Vuelo: <span class="font-semibold">{{ $fly->fly_duration ?? 'N/A' }} horas</span></p>
                                            <p>Cantidad de Asientos Disponibles: <span class="font-semibold">{{ $fly->seat_count }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Botón para Detalles -->
                                    <a href="{{ route('vuelos.show', ['id_fly' => $fly->id, 'cant_pasajeros'=>$cant_pasajeros]) }}"
                                       class="flex bg-indigo-500 text-white rounded-lg p-2 mx-auto justify-center">
                                        Ver detalles del Vuelo
                                        <svg class="w-6 h-6 text-white items-end dark:text-white ml-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
