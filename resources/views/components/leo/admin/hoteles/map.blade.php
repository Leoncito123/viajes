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
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Ubicación del hotel
                        </h3>
                        <button type="button"
                            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            onclick="closeLocationModal()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class=" h-2/3">
                        <iframe id="hotelMap" width="100%" height="100%" style="border:0;" loading="lazy"
                            allowfullscreen src="">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para el modal -->
<script>
    const locationModal = document.getElementById('locationModal');
    const hotelMap = document.getElementById('hotelMap');

    function openLocationModal(latitude, longitude) {
        const src =
            `https://www.openstreetmap.org/export/embed.html?bbox=${longitude-0.02},${latitude-0.02},${longitude+0.02},${latitude+0.02}&layer=mapnik&marker=${latitude},${longitude}`;
        hotelMap.src = src;
        locationModal.classList.remove('hidden');
    }

    function closeLocationModal() {
        locationModal.classList.add('hidden');
    }
</script>
