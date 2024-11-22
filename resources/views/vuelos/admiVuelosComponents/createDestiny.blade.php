
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown5" class="text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Crear Destino<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdown5" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
        <div id="map" class="h-96 w-full rounded-lg shadow-lg border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:border-gray-700"></div>

        <form action="{{route('destiny.store')}}" method="POST" class="py-6 p-4">
            @csrf
            <div>
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Nombre de la Ubicación
                </label>
                <input type="text" name="nombre" id="nombre"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                     </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
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
                        <div class="mt-4">
                            <button type="submit" class="p-2 bg-indigo-500 dark:bg-blue-500 text-white rounded-lg">Crear</button>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Agregar más campos de imagen
                                const addImageButton = document.getElementById('add-image');
                                if (addImageButton) {
                                    addImageButton.addEventListener('click', function () {
                                        const container = document.getElementById('image-container');
                                        if (!container) return;

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
                                        const removeButton = newEntry.querySelector('.remove-image');
                                        if (removeButton) {
                                            removeButton.addEventListener('click', function () {
                                                newEntry.remove();
                                            });
                                        }
                                    });
                                }

                                // Inicializar el mapa
                                const mapElement = document.getElementById('map');
                                if (mapElement) {
                                    const map = L.map('map').setView([20.5881, -100.3889], 13); // Coordenadas iniciales

                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                    }).addTo(map);

                                    const marker = L.marker([20.5881, -100.3889], { draggable: true }).addTo(map);

                                    // Calcular distancia
                                    function calculateDistance(lat1, lon1, lat2, lon2) {
                                        const R = 6371; // Radio de la Tierra en km
                                        const dLat = (lat2 - lat1) * Math.PI / 180;
                                        const dLon = (lon2 - lon1) * Math.PI / 180;
                                        const a = 0.5 - Math.cos(dLat) / 2 +
                                            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                                            (1 - Math.cos(dLon)) / 2;
                                        return R * 2 * Math.asin(Math.sqrt(a));
                                    }

                                    function updateDistance(latlng) {
                                        const centerLatLng = { lat: 20.5881, lng: -100.3889 }; // Centro de Querétaro
                                        const distance = calculateDistance(centerLatLng.lat, centerLatLng.lng, latlng.lat, latlng.lng);
                                        const distanceField = document.getElementById('town_center_distance');
                                        if (distanceField) {
                                            distanceField.value = distance.toFixed(2);
                                        }
                                    }

                                    // Eventos para actualizar latitud, longitud y distancia
                                    marker.on('dragend', function () {
                                        const latlng = marker.getLatLng();
                                        document.getElementById('latitude').value = latlng.lat;
                                        document.getElementById('longitude').value = latlng.lng;
                                        updateDistance(latlng);
                                    });

                                    map.on('click', function (e) {
                                        marker.setLatLng(e.latlng);
                                        document.getElementById('latitude').value = e.latlng.lat;
                                        document.getElementById('longitude').value = e.latlng.lng;
                                        updateDistance(e.latlng);
                                    });

                                    // Agregar el geocoder
                                    const geocoder = L.Control.geocoder({
                                        defaultMarkGeocode: false
                                    }).on('markgeocode', function (e) {
                                        const latlng = e.geocode.center;
                                        marker.setLatLng(latlng);
                                        map.setView(latlng, 13);
                                        document.getElementById('latitude').value = latlng.lat;
                                        document.getElementById('longitude').value = latlng.lng;
                                        updateDistance(latlng);
                                    }).addTo(map);
                                }
                            });
                        </script>

        </form>

    </div>


