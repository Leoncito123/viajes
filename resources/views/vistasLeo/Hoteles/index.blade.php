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

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="relative h-48">
                        <img src="https://lh3.googleusercontent.com/p/AF1QipP18V5_1zWs-kbvR2HdWBznU8FRKgI4Wv1dt6eg=s680-w680-h510"
                            alt="Hotel Mousai" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            Hotel Mousai - Adults Only
                        </h3>
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-blue-600 font-semibold">9.4</span>
                            <span class="text-blue-600">- Excelente</span>
                            <span class="text-gray-600 dark:text-gray-400">(3513)</span>
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">Puerto Vallarta</span>
                        </div>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex items-center text-gray-600 dark:text-gray-400">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span class="text-sm">3.40 km del centro</span>
                            </div>
                        </div>
                        <button onclick="openModal(1)"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                            Consultar precios
                        </button>
                    </div>
                </div>


                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="relative h-48">
                        <img src="data:image/jpeg;base64,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"
                            alt="Grand Velas Riviera Maya" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            Grand Velas Riviera Maya
                        </h3>
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-blue-600 font-semibold">9.7</span>
                            <span class="text-blue-600">- Excelente</span>
                            <span class="text-gray-600 dark:text-gray-400">(14969)</span>
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">Playa del Carmen</span>
                        </div>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex items-center text-gray-600 dark:text-gray-400">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span class="text-sm">4.40 km del centro</span>
                            </div>
                        </div>
                        <button onclick="openModal(2)"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                            Consultar precios
                        </button>
                    </div>
                </div>


                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="relative h-48">
                        <img src="https://image-tc.galaxy.tf/wijpeg-6xn7225cn8o9voofhdud838g0/aerea-3-result.jpg"
                            alt="Live Aqua Beach Resort" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            Live Aqua Beach Resort Cancún
                        </h3>
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-blue-600 font-semibold">9.2</span>
                            <span class="text-blue-600">- Excelente</span>
                            <span class="text-gray-600 dark:text-gray-400">(21823)</span>
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">Cancún</span>
                        </div>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex items-center text-gray-600 dark:text-gray-400">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span class="text-sm">3.40 km del centro</span>
                            </div>
                        </div>
                        <button onclick="openModal(1)"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                            Consultar precios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-leo.hoteles.modal-info name="Hotel Mousai - Adults Only" info="Mucha info"
        image="{{ asset('imagesLeo/Hoteles/hm.jpg') }}" id="1" />
    <x-leo.hoteles.modal-info name="name" info="info" image="image" id="2" />
    <x-leo.hoteles.modal-info name="name" info="info" image="image" id="3" />

    <script>
        function openModal(id) {
            document.getElementById('modal-info-' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('modal-info-' + id).classList.add('hidden');
        }
    </script>
</x-app-layout>
