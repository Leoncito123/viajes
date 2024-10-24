<!-- Modal -->
<div id="locationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- Modal Background Overlay -->
    <div class="fixed inset-0 bg-black opacity-50" onclick="closeLocationModal()"></div>

    <!-- Modal Content -->
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full">
            <!-- Modal Body -->
            <div class="p-6">
                <!-- Mapa Container -->
                <div class="relative w-full h-96 rounded-lg overflow-hidden">
                    <iframe id="hotelMap" width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen
                        src="https://www.openstreetmap.org/export/embed.html?bbox=-105.2720,20.6500,-105.2320,20.6900&layer=mapnik&marker=20.6700,-105.2520">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para el modal -->
<script>
    function openLocationModal(latitude, longitude) {
        latitude = 20.6700;
        longitude = 120.2520;

        const bbox = calculateBoundingBox(latitude, longitude, 0.02);
        const mapUrl =
            `https://www.openstreetmap.org/export/embed.html?bbox=${bbox.west},${bbox.south},${bbox.east},${bbox.north}&layer=mapnik&marker=${latitude},${longitude}`;
        mapEl.src = mapUrl;

        // Mostrar el modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLocationModal() {
        const modal = document.getElementById('locationModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Cerrar modal con la tecla Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLocationModal();
        }
    });
</script>
