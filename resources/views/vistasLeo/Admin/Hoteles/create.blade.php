@extends('vistasLeo.Admin.index')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Crear un nuevo hotel
            </h3>
        </div>
        <div class="p-4 md:p-5">
            <form class="space-y-4 w-full" action="{{ route('admin.hoteles.create') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('POST')

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">¡Ups!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><span class="block sm:inline">{{ $error }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nombre del Hotel
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>

                    <div>
                        <label for="name_hotel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nombre de la ubicación
                        </label>
                        <input type="text" name="name_hotel" id="name_hotel" value="{{ old('name_hotel') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Teléfono
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>

                    <div>
                        <label for="stars" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Clasificación (estrellas)
                        </label>
                        <select name="stars" id="stars"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                    </div>

                    {{-- descripcion --}}
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Descripción
                        </label>
                        <textarea name="description_hotel" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="services" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Servicios
                        </label>
                        <select id="services" name="services[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="name_hotel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Número de habitaciones
                        </label>
                        <input type="number" name="number_rooms" id="name_hotel" value="{{ old('name_hotel') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <div class="mt-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Fotos del hotel con descripción
                        </label>
                        <div id="image-container">
                            <div class="image-entry mb-4">
                                <div class="flex items-center space-x-4">
                                    <input type="file" name="images[]" required
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    <input type="text" name="descriptions[]" placeholder="Descripción de la imagen"
                                        required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-image"
                            class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            Agregar otra imagen
                        </button>
                    </div>

                    <!-- Mapa -->
                    <div class="space-y-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Seleccionar ubicación en el mapa
                        </label>
                        <div id="map" class="h-64 w-full rounded-lg"></div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="latitude" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Latitud
                                </label>
                                <input type="text" name="latitude" id="latitude" readonly
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="longitude" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Longitud
                                </label>
                                <input type="text" name="longitude" id="longitude" readonly
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="town_center_distance"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Distancia al centro (km)
                                </label>
                                <input type="text" name="town_center_distance" id="town_center_distance" readonly
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full h-20 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Crear hotel
                    </button>
            </form>
        </div>
    </div>

    <script>
        // Función para agregar más campos de imagen
        document.getElementById('add-image').addEventListener('click', function() {
            const container = document.getElementById('image-container');
            const newEntry = document.createElement('div');
            newEntry.className = 'image-entry mb-4';
            newEntry.innerHTML = `
                <div class="flex items-center space-x-4">
                    <input type="file" name="images[]" accept="image/*" required
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    <input type="text" name="descriptions[]" placeholder="Descripción de la imagen" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <button type="button" class="remove-image px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                        Eliminar
                    </button>
                </div>
            `;
            container.appendChild(newEntry);

            // Agregar evento para eliminar la entrada
            newEntry.querySelector('.remove-image').addEventListener('click', function() {
                newEntry.remove();
            });
        });

        // Código del mapa
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([20.5881, -100.3889], 13); // Coordenadas de Querétaro

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([20.5881, -100.3889], {
                draggable: true
            }).addTo(map);

            function calculateDistance(lat1, lon1, lat2, lon2) {
                var R = 6371;
                var dLat = (lat2 - lat1) * Math.PI / 180;
                var dLon = (lon2 - lon1) * Math.PI / 180;
                var a = 0.5 - Math.cos(dLat) / 2 +
                    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                    (1 - Math.cos(dLon)) / 2;
                return R * 2 * Math.asin(Math.sqrt(a));
            }

            function updateDistance(latlng) {
                // Centro de Querétaro
                const centerLatLng = {
                    lat: 20.5881,
                    lng: -100.3889
                };
                var distance = calculateDistance(centerLatLng.lat, centerLatLng.lng, latlng.lat, latlng.lng);
                document.getElementById('town_center_distance').value = distance.toFixed(2);
            }

            marker.on('dragend', function(e) {
                var latlng = marker.getLatLng();
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
                updateDistance(latlng);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                document.getElementById('latitude').value = e.latlng.lat;
                document.getElementById('longitude').value = e.latlng.lng;
                updateDistance(e.latlng);
            });

            var geocoder = L.Control.geocoder({
                defaultMarkGeocode: false
            }).on('markgeocode', function(e) {
                var latlng = e.geocode.center;
                marker.setLatLng(latlng);
                map.setView(latlng, 13);
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
                updateDistance(latlng);
            }).addTo(map);
        });
    </script>
@endsection
