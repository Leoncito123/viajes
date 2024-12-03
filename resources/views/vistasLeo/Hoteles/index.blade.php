<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hoteles') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <form method="GET" action="{{ route('hoteles.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Destino -->
                    <div>
                        <label for="destination" class="block mb-2 text-sm">Destino</label>
                        <input type="text" name="destination" id="destination"
                            class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="¿A dónde irás?">
                    </div>

                    <!-- Fechas -->
                    <div class="sm:col-span-2 md:col-span-1 flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <label for="checkin" class="block mb-2 text-sm">Llegada</label>
                            <input type="date" name="checkin" id="checkin"
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex-1">
                            <label for="checkout" class="block mb-2 text-sm">Salida</label>
                            <input type="date" name="checkout" id="checkout"
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Habitaciones y Huéspedes -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="rooms" class="block mb-2 text-sm">Habitaciones</label>
                            <input type="number" name="rooms" id="rooms"
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                                min="1" value="1">
                        </div>
                        <div>
                            <label for="guests" class="block mb-2 text-sm">Huéspedes</label>
                            <input type="number" name="guests" id="guests"
                                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                                min="1" value="1">
                        </div>
                    </div>

                    <!-- Estrellas -->
                    <div>
                        <label class="block mb-2 text-sm">Estrellas</label>
                        <div class="flex flex-wrap gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <label class="inline-flex items-center space-x-2">
                                    <input type="checkbox" name="stars[]" value="{{ $i }}"
                                        class="form-checkbox">
                                    <span>{{ $i }} ⭐</span>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <!-- Rango de precios -->
                    <div>
                        <label class="block mb-2 text-sm">Rango de Precio</label>
                        <div class="flex gap-4">
                            <input type="number" name="min_price" placeholder="Mínimo"
                                class="w-1/2 px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <input type="number" name="max_price" placeholder="Máximo"
                                class="w-1/2 px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Servicios -->
                    <div>
                        <label class="block mb-2 text-sm">Servicios</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($services as $service)
                                <label class="inline-flex items-center space-x-2">
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                        class="form-checkbox">
                                    <span>{{ $service->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Distancia -->
                    <div>
                        <label for="max_distance" class="block mb-2 text-sm">Distancia máxima (km)</label>
                        <input type="number" name="max_distance" id="max_distance"
                            class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Distancia máxima">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                        Buscar Hoteles
                    </button>
                </div>
            </form>
        </div>

        <!-- Listado de Hoteles -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($hoteles as $hotel)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <div class="relative h-48">
                            <img src="{{ $hotel->pictures->isNotEmpty() ? asset('storage/' . $hotel->pictures->first()->name) : '' }}"
                                alt="{{ $hotel->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $hotel->name }}
                            </h3>
                            <div class="flex items-center space-x-2 mb-2 text-blue-600">
                                <span class="font-semibold">{{ $hotel->rating }}</span>
                                <span>{{ $hotel->stars }} ⭐</span>
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                Distancia al centro: {{ $hotel->town_center_distance }} km
                            </div>
                            <a href="{{ route('hoteles.show', $hotel->id) }}"
                                class="block bg-blue-600 text-white py-2 px-4 text-center rounded-md hover:bg-blue-700">
                                Consultar precios
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
