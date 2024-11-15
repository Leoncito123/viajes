@extends('vistasLeo.Admin.index')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
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
    @include('vistasLeo.Admin.Hoteles.gestion.index')
    <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Hoteles</h2>
        <div class="flex items-center">
            <a class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105"
                href="{{ route('admin.hoteles.create') }}">
                Crear
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ubicación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Número telefónico
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clasificación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Distancia al centro
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Servicios
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Número de habitaciones
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Políticas
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($hoteles->isEmpty())
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" colspan="8"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                No hay hoteles registrados
                            </th>
                        </tr>
                    @else
                        @foreach ($hoteles as $hotel)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $hotel->name }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $hotel->destiny->name }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $hotel->phone }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        @for ($i = 0; $i < $hotel->stars; $i++)
                                            <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $hotel->town_center_distance }} km
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @foreach ($hotel->services as $service)
                                        <span
                                            class="bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-gray-700 px-2 py-1 rounded-lg text-xs">
                                            {{ $service->name }}
                                        </span>
                                    @endforeach
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a class="text-blue-600 hover:text-blue-700"
                                        href="{{ route('admin.hoteles.rooms', $hotel->id) }}">
                                        {{ $hotel->rooms->count() }}
                                    </a>
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a class="text-blue-600 hover:text-blue-700"
                                        href="{{ route('admin.hoteles.politicas', $hotel->id) }}">
                                        Ver políticas
                                    </a>
                                </th>

                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.hoteles.edit', $hotel->id) }}"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                                            Editar
                                        </a>
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105"
                                            onclick="eliminarHotel({{ $hotel->id }})">
                                            Eliminar
                                        </button>
                                        <button
                                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105"
                                            onclick="openLocationModal({{ $hotel->destiny->latitude }}, {{ $hotel->destiny->longitude }})">
                                            Ver ubicación
                                        </button>

                                        <button
                                            class="bg-fuchsia-500 hover:bg-fuchsia-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105"
                                            onclick="openImagesModal({{ $hotel->id }})">
                                            Ver imágenes
                                        </button>
                                        <a href="{{ route('admin.hoteles.rooms.reservation', $hotel->id) }}"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                                            Ver reservaciones
                                        </a>
                                        <a href="{{ route('admin.hoteles.coments', $hotel->id) }}"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                                            Ver comentarios
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <div id="modal-images" class="hidden fixed z-10 inset-0 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen">
                                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md w-full max-w-3xl">
                                        <div class="flex justify-between items-center">
                                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Imágenes del Hotel
                                            </h2>
                                            <button onclick="closeImagesModal()"
                                                class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                                &times;
                                            </button>
                                        </div>
                                        <div id="images-container"
                                            class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <x-leo.admin.hoteles.edit />
    <x-leo.admin.hoteles.create />
    <x-leo.admin.hoteles.map />
    <x-leo.admin.hoteles.images />
    <script>
        function openModal() {
            document.getElementById('modal-edit').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-edit').classList.add('hidden');
        }

        function eliminarHotel(id) {
            Swal.fire({
                title: "¿Estás seguro de eliminar este Hotel?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar",
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteHotel(id);
                }
            });
        }

        function deleteHotel(id) {
            fetch(`/admin/hoteles/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                window.location.reload();
            })
        }

        function openCreateModal() {
            document.getElementById('modal-create').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('modal-create').classList.add('hidden');
        }

        function openImagesModal() {
            document.getElementById('modal-images').classList.remove('hidden');
        }

        function openImagesModal(hotelId) {
            const hoteles = @json($hoteles);
            const selectedHotel = hoteles.find(h => h.id === hotelId);
            const imagesContainer = document.getElementById('images-container');
            imagesContainer.innerHTML = '';
            selectedHotel.pictures.forEach(picture => {
                const figureElement = document.createElement('figure');
                const imgElement = document.createElement('img');
                const pieimgElement = document.createElement('figcaption');

                imgElement.src = `{{ asset('storage/') }}/${picture.name}`;
                imgElement.alt = 'hotel';
                imgElement.classList.add('w-full', 'h-auto', 'rounded-lg');

                pieimgElement.innerHTML = picture.description;

                figureElement.appendChild(imgElement);
                figureElement.appendChild(pieimgElement);
                imagesContainer.appendChild(figureElement);
            });
            document.getElementById('modal-images').classList.remove('hidden');
        }

        function closeImagesModal() {
            document.getElementById('modal-images').classList.add('hidden');
        }
    </script>
@endsection
