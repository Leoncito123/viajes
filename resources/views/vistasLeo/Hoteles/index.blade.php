<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hoteles') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <form method="GET"
                class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/3">
                    <label for="destination" class="sr-only">Lugar de interés</label>
                    <input type="text" name="destination" id="destination"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="¿A dónde irás?">
                </div>
                <div class="w-full md:w-1/4 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <div class="w-full md:flex-1">
                        <label for="checkin" class="sr-only">Llegada</label>
                        <input type="date" name="checkin" id="checkin"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="w-full md:flex-1">
                        <label for="checkout" class="sr-only">Salida</label>
                        <input type="date" name="checkout" id="checkout"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="w-full md:w-1/6">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($hoteles as $hotel)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <div class="relative h-48">
                            <img src="{{ asset('storage/' . $hotel->pictures->first()->name) }}" alt="Hotel Mousai"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $hotel->name }}
                            </h3>
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="text-blue-600 font-semibold">9.4</span>
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                {{ $hotel->stars }}
                            </div>
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span class="text-sm">{{ $hotel->town_center_distance }} km</span>
                                </div>
                            </div>
                            <a href="{{ route('hoteles.show', $hotel->id) }}"
                                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                                Consultar precios
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
