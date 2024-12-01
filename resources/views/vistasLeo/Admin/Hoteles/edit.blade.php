@extends('vistasLeo.Admin.index')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Crear un nuevo hotel
            </h3>
        </div>
        <div class="p-4 md:p-5">
            <form class="space-y-4 w-full" action="{{ route('admin.hoteles.edit', $hotel->id) }}" method="POST"
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
                        <input type="text" name="name" id="name" value="{{ $hotel->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>

                    <div>
                        <label for="name_hotel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nombre de la ubicación
                        </label>
                        <input type="text" name="name_hotel" id="name_hotel" value="{{ $hotel->destiny->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Teléfono
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ $hotel->phone }}"
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
                            <option value="0" {{ $hotel->stars == 0 ? 'selected' : '' }}>Selecciona una opción</option>
                            <option value="1" {{ $hotel->stars == 1 ? 'selected' : '' }}>⭐</option>
                            <option value="2" {{ $hotel->stars == 2 ? 'selected' : '' }}>⭐⭐</option>
                            <option value="3" {{ $hotel->stars == 3 ? 'selected' : '' }}>⭐⭐⭐</option>
                            <option value="4" {{ $hotel->stars == 4 ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                            <option value="5" {{ $hotel->stars == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Descripción
                        </label>
                        <textarea name="description_hotel" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>{{$hotel->description}}</textarea>
                    </div>

                    <div>
                        <label for="services" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Servicios
                        </label>
                        <select id="services" name="services[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ $hotel->services->contains($service->id) ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="name_hotel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Número de habitaciones
                        </label>
                        <input type="number" name="number_rooms" id="name_hotel" value="{{ $hotel->rooms->count() }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required disabled />
                    </div>
                    <div class="mt-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Fotos del hotel con descripción
                        </label>

                        <!-- Fotos existentes -->
                        <div class="mb-4">
                            <h3 class="text-lg font-medium mb-2">Fotos actuales</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($hotel->pictures as $picture)
                                    <div class="border p-4 rounded-lg">
                                        <img src="{{ asset('storage/' . $picture->name) }}"
                                            class="w-full h-48 object-cover mb-2">
                                        <input type="text" name="existing_descriptions[{{ $picture->id }}]"
                                            value="{{ $picture->description }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <div class="flex justify-end mt-2">
                                            <button type="button" onclick="deleteImage({{ $picture->id }})"
                                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                Eliminar
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Nuevas fotos -->
                        <div id="image-container">
                            <h3 class="text-lg font-medium mb-2">Agregar nuevas fotos</h3>
                            <div class="image-entry mb-4">
                                <div class="flex items-center space-x-4">
                                    <input type="file" name="new_images[]"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                    <input type="text" name="new_descriptions[]" placeholder="Descripción de la imagen"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-image"
                            class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Agregar otra imagen
                        </button>
                    </div>

                    <script>
                        function deleteImage(imageId) {
                            Swal.fire({
                                title: "¿Estás seguro de eliminar esta imagen?",
                                text: "Esta acción no se puede deshacer.",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Si, eliminar",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch(`/admin/hoteles/images/delete/${imageId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    }).then(response => {
                                        window.location.reload();
                                    });
                                }
                            });
                        }

                        document.getElementById('add-image').addEventListener('click', function() {
                            const container = document.getElementById('image-container');
                            const newEntry = document.createElement('div');
                            newEntry.className = 'image-entry mb-4';
                            newEntry.innerHTML = `
                          <div class="flex items-center space-x-4">
                              <input type="file" name="new_images[]" 
                                  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                              <input type="text" name="new_descriptions[]" 
                                  placeholder="Descripción de la imagen"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                          </div>
                      `;
                            container.appendChild(newEntry);
                        });
                    </script>

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
                                    value="{{ $hotel->destiny->latitude }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="longitude"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Longitud
                                </label>
                                <input type="text" name="longitude" id="longitude" readonly
                                    value="{{ $hotel->destiny->longitude }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="town_center_distance"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Distancia al centro (km)
                                </label>
                                <input type="text" name="town_center_distance" id="town_center_distance" readonly
                                    value="{{ $hotel->town_center_distance }}"
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
            const lat = document.getElementById('latitude').value;
            const lng = document.getElementById('longitude').value;
            var map = L.map('map').setView([lat, lng], 13); // Coordenadas de Querétaro

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([lat, lng], {
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
