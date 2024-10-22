<div>
    <div id="map" style="height: 400px; width: 100%;"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Crear el mapa
            var map = L.map('map').setView([{{ $longitude }},
                {{ $latitude }}
            ], 50); // Coordenadas por defecto (Londres)

            // Añadir el "tile layer" de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Marcador en las coordenadas específicas
            var marker = L.marker([{{ $longitude }}, {{ $latitude }}]).addTo(map);

            // Mensaje popup cuando haces clic en el marcador
            marker.bindPopup("<b>¡Hola!</b><br>Esta es una ubicación.").openPopup();
        });
    </script>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
