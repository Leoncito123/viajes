<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hotel') }} {{ $hotel->name }}
        </h2>
    </x-slot>

    <div class="relative w-full max-w-7xl">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Carrusel -->
            <div class="p-4 space-y-4">
                <div id="carouselExample" class="relative" data-carousel="static">
                    <div class="relative w-full h-80 overflow-hidden rounded-lg">
                        @foreach ($hotel->pictures as $picture)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="{{ asset('storage/' . $picture->name) }}"
                                    class="block w-full h-full object-cover" alt="Hotel Image">
                            </div>
                        @endforeach
                    </div>
                    <!-- Controles -->
                    <button class="absolute bg-black rounded-full opacity-50 top-0 left-0 z-30 p-2 focus:outline-none"
                        data-carousel-prev>
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="absolute bg-black opacity-50 rounded-full top-0 right-0 z-30 p-2 focus:outline-none"
                        data-carousel-next>
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                {{-- Mapa --}}
                <div class="h-96 rounded-lg" id="map">
                    <x-leo.hoteles.hotel-mapa longitude='{{ $hotel->destiny->longitude }}'
                        latitude='{{ $hotel->destiny->latitude }}' />
                </div>

                <!-- Servicios -->
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Servicios</h1>
                <div class="flex flex-wrap gap-2">
                    @foreach ($hotel->services as $service)
                        <span class="px-3 py-1 bg-gray-200 rounded-lg dark:bg-gray-800 text-sm dark:text-gray-300">
                            {{ $service->name }}: {{ $service->description }}
                        </span>
                    @endforeach
                </div>

                <!-- Selección dinámica de habitaciones -->
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Selecciona una habitación</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($hotel->rooms as $room)
                        <div class="border rounded-lg p-4 bg-white dark:bg-gray-800">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">{{ $room->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Capacidad:
                                {{ $room->type_room ? $room->type_room->max_people ?? 'N/A' : 'Sin información' }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Precio:
                                ${{ $room->type_room ? $room->type_room->price ?? 'N/A' : 'Sin información' }}</p>
                            <button type="button"
                                class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Seleccionar
                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Formulario -->
                <div class="mt-6">
                    <form action="{{ route('reservation.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-4">
                            <!-- Cantidad de adultos -->
                            <div class="flex items-center gap-4">
                                <label for="adults" class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                    Adultos:
                                </label>
                                <div class="flex items-center">
                                    <button type="button" id="decrement-adults"
                                        class="bg-gray-200 dark:bg-gray-700 p-2 rounded-l-lg text-gray-700 dark:text-gray-300">-</button>
                                    <input type="number" id="adults" name="adults" value="1" min="0"
                                        class="w-16 text-center bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-none text-gray-900 dark:text-gray-200">
                                    <button type="button" id="increment-adults"
                                        class="bg-gray-200 dark:bg-gray-700 p-2 rounded-r-lg text-gray-700 dark:text-gray-300">+</button>
                                </div>
                            </div>
                            <!-- Cantidad de niños -->
                            <div class="flex items-center gap-4">
                                <label for="kids" class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                    Niños:
                                </label>
                                <div class="flex items-center">
                                    <button type="button" id="decrement-kids"
                                        class="bg-gray-200 dark:bg-gray-700 p-2 rounded-l-lg text-gray-700 dark:text-gray-300">-</button>
                                    <input type="number" id="kids" name="kids" value="0" min="0"
                                        class="w-16 text-center bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-none text-gray-900 dark:text-gray-200">
                                    <button type="button" id="increment-kids"
                                        class="bg-gray-200 dark:bg-gray-700 p-2 rounded-r-lg text-gray-700 dark:text-gray-300">+</button>
                                </div>
                            </div>
                            <!-- Fechas -->
                            <div>
                                <label for="date-range"
                                    class="block text-sm font-medium text-gray-900 dark:text-gray-200">Fechas:</label>
                                <input type="text" id="date-range" name="date_range"
                                    class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                            </div>
                            <!-- Botón de envío -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Reservar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- Comentarios --}}
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Comentarios</h1>
                <x-leo.hoteles.comentarios :coments="$hotel->opinions" />
            </div>
        </div>
</x-app-layout>
