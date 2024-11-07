<!-- Main modal -->
<div id="modal-create" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden w-auto">
    <div class="relative p-4 w-full max-h-full max-w-screen-lg">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Crear un nuevo hotel
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="closeCreateModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4 w-full" action="{{ route('admin.hoteles.create') }}" method="POST">
                    @csrf
                    @method('POST')
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">¡Ups!</strong>
                            <li>
                                @foreach ($errors->all() as $error)
                                    <ul>
                                        <span class="block sm:inline">{{ $error }}</span>
                                    </ul>
                                @endforeach
                            </li>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="hotel-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del
                                Hotel</label>
                            <input type="text" name="hotel-name" id="hotel-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="" />
                        </div>
                        <div>
                            <label for="check-in"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                                Check-in</label>
                            <input type="date" name="check-in" id="check-in"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        </div>
                        <div>
                            <label for="check-out"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                                Check-out</label>
                            <input type="date" name="check-out" id="check-out"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        </div>
                        <div>
                            <label for="rooms"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de
                                habitaciones</label>
                            <input type="number" name="rooms" id="rooms"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="0" />
                        </div>
                        <div>
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                            <input type="text" name="category" id="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="" />
                        </div>
                        <div>
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                            <input type="number" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="0" />
                        </div>
                        <div>
                            <label for="distance"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Distancia al
                                centro</label>
                            <input type="number" name="distance" id="distance"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="0" />
                        </div>
                        <div>
                            <label for="services"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servicios</label>
                            <input type="text" name="services" id="services"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="" />
                        </div>
                        <div>
                            <label for="file"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagen del
                                hotel</label>
                            <input type="file" name="file" id="file"
                                class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                        </div>
                        <div>
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción del
                                Hotel</label>
                            <textarea name="description" id="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Escribe una descripción..."></textarea>
                        </div>
                    </div>
                    <div>
                        <label for="map"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar ubicación
                            en el mapa</label>
                        <div id="map" class="h-64 w-full rounded-lg"></div>
                        <input type="hidden" name="location-coordinates" id="location-coordinates" />
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear
                        hotel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- Leaflet Geocoder CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<!-- Leaflet Geocoder JS -->
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([51.505, -0.09], {
            draggable: true
        }).addTo(map);

        function calculateDistance(lat1, lon1, lat2, lon2) {
            var R = 6371; // Radio de la Tierra en km
            var dLat = (lat2 - lat1) * Math.PI / 180;
            var dLon = (lon2 - lon1) * Math.PI / 180;
            var a =
                0.5 - Math.cos(dLat) / 2 +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                (1 - Math.cos(dLon)) / 2;

            return R * 2 * Math.asin(Math.sqrt(a));
        }

        function updateDistance(latlng) {
            fetch(`https://nominatim.openstreetmap.org/search?city=queretaro&format=json&limit=1`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const centerLatLng = {
                            lat: data[0].lat,
                            lng: data[0].lon
                        };
                        // Aquí calculas la distancia
                        var distance = calculateDistance(centerLatLng.lat, centerLatLng.lng, latlng.lat,
                            latlng.lng);
                        document.getElementById('distance').value = distance.toFixed(2); // Distancia en km
                    } else {
                        document.getElementById('distance').value = '';
                        alert('No se pudo encontrar la ubicación del centro para esta ciudad.');
                    }
                });
        }

        marker.on('dragend', function(e) {
            var latlng = marker.getLatLng();
            document.getElementById('location-coordinates').value = latlng.lat + ',' + latlng.lng;
            updateDistance(latlng);
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('location-coordinates').value = e.latlng.lat + ',' + e.latlng.lng;
            updateDistance(e.latlng);
        });

        var geocoder = L.Control.geocoder({
            defaultMarkGeocode: false
        }).on('markgeocode', function(e) {
            var latlng = e.geocode.center;
            marker.setLatLng(latlng);
            map.setView(latlng, 13);
            document.getElementById('location-coordinates').value = latlng.lat + ',' + latlng.lng;
            updateDistance(latlng);
        }).addTo(map);

        form.addEventListener('submit', function(event) {
            event.preventDefault(): ;

            var formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.succes) {
                        Swal.fire({
                            icon: "success",
                            title: "Se ha creado exitosamente el hotel",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: "error",
                        title: "¡Ups!",
                        text: "Ha ocurrido un error al crear el hotel",
                        showConfirmButton: false,
                        timer: 1500
                    });
                });

        })
    });
</script>
