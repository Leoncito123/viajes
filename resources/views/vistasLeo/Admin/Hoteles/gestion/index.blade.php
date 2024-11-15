<!-- drawer init and toggle -->
<div>
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
    <!-- Botón para abrir el drawer -->
    <button class="text-white bg-indigo-500 p-2 rounded-lg" type="button" data-drawer-show="drawer-example">
        Gestión del Vuelo
    </button>

    <!-- drawer component -->
    <div id="drawer-example"
        class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-full lg:w-11/12 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label">
        <div class="flex justify-end text-center mb-4">
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-2 text-center"
                data-modal-hide="drawer-example">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const drawer = document.getElementById('drawer-example');
                const closeButton = document.querySelector('[data-modal-hide="drawer-example"]');

                document.querySelector('[data-drawer-show="drawer-example"]').addEventListener('click', function() {
                    drawer.classList.remove('-translate-x-full');
                });

                closeButton.addEventListener('click', function() {
                    drawer.classList.add('-translate-x-full');
                });
            });

            function eliminarServicio(id) {
                Swal.fire({
                    title: "¿Estás seguro de eliminar este servicio?",
                    text: "Esta acción no se puede deshacer.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteServicio(id);
                    }
                });
            }

            function deleteServicio(servicio) {
                fetch(`/admin/servicios/delete/${servicio}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    location.reload();
                })
            }

            function eliminarType(id) {
                Swal.fire({
                    title: "¿Estás seguro de eliminar este tipo de habitación?",
                    text: "Esta acción no se puede deshacer.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteTipo(id);
                    }
                });
            }

            function deleteTipo(id) {
                fetch(`/admin/hoteles/type_rooms/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    location.reload();
                })
            }
        </script>
        <div class="p-4">
            <p class="text-2xl font-semibold">Gestión de Vuelos</p>
        </div>
        <div class="p-4">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="border border-indigo-500 rounded-lg p-4">
                    <div class="">
                        <p class="text-lg font-semibold">Gestion de Servicios</p>
                    </div>
                    <div class="flex py-2">
                        <button onclick="openCreateServiceModal()"
                            class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
                    </div>
                    <div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs  uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Nombre del servicio
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Descripción
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($servicios) == 0)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                                colspan="3">
                                                No hay servicios registrados
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($servicios as $servicio)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $servicio->name }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $servicio->description }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <button
                                                        onclick="openEditServiceModal({{ $servicio->id }}, '{{ $servicio->name }}', '{{ $servicio->description }}')"
                                                        class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                                    <button onclick="eliminarServicio({{ $servicio->id }})"
                                                        class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="border border-indigo-500 rounded-lg p-4">
                    <div class="">
                        <p class="text-lg font-semibold">Gestion de tipo de habitaciones</p>
                    </div>
                    <div class="flex py-2">
                        <button onclick="openCreateTypeModal()"
                            class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
                    </div>
                    <div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs  uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Nombre del tipo de habitación
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Descripción
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Precio
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Maxima cantidad de personas
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($type_rooms) == 0)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                                colspan="3">
                                                No hay servicios registrados
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($type_rooms as $type_room)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $type_room->name }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $type_room->description }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $type_room->price }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $type_room->max_people }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <button
                                                        onclick="openEditTypeModal({{ $type_room->id }}, '{{ $type_room->name }}', '{{ $type_room->description }}', '{{ $type_room->price }}', '{{ $type_room->max_people }}')"
                                                        class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</button>
                                                    <button onclick="eliminarType({{ $type_room->id }})"
                                                        class="p-2 rounded-lg font-semibold text-white bg-red-500">Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Servicios --}}
<!-- Modal de creación de servicios -->
<div id="create-service-modal"
    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-md p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Crear Servicio</h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-2"
                onclick="closeCreateServiceModal()">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form action="{{ route('admin.servicios.create') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="service-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                    del Servicio</label>
                <input type="text" id="service-name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
            <div class="mb-4">
                <label for="service-description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                <textarea id="service-description" name="description" rows="4"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required></textarea>
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear
                Servicio</button>
        </form>
    </div>
</div>
{{-- modal de editar el servicios --}}
<div id="edit-service-modal"
    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-md p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Editar Servicio</h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-2"
                onclick="document.getElementById('edit-service-modal').classList.add('hidden')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form id="edit-service-form" method="POST">
            @csrf
            <input type="hidden" id="edit-service-id" name="id">
            <div class="mb-4">
                <label for="edit-service-name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Servicio</label>
                <input type="text" id="edit-service-name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
            <div class="mb-4">
                <label for="edit-service-description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                <textarea id="edit-service-description" name="description" rows="4"
                    class="bg-gray-50
                    border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required></textarea>
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar
                Servicio</button>
        </form>
    </div>
</div>
{{-- Fin de servicios --}}

{{-- Tipo de habitaciones --}}
<!-- Modal de creación de tipo -->
<div id="create-type-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-md p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Crear Tipo de Habitación</h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-2"
                onclick="document.getElementById('create-type-modal').classList.add('hidden')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form action="{{ route('admin.hoteles.type_rooms.create') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="type-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del
                    Tipo de Habitación</label>
                <input type="text" id="type-name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
            <div class="mb-4">
                <label for="type-description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                <textarea id="type-description" name="description" rows="4"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required></textarea>
            </div>
            <div class="mb-4">
                <label for="type-price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                <input type="number" id="type-price" name="price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
            <div class="mb-4">
                <label for="type-max-people"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Máxima cantidad de
                    personas</label>
                <input type="number" id="type-max-people" name="max_people"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear
                Tipo de Habitación</button>
        </form>
    </div>
</div>

{{-- modal de editar el tipo --}}

<div id="edit-type-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-md p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Editar Tipo de Habitación</h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-2"
                onclick="document.getElementById('edit-type-modal').classList.add('hidden')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form id="edit-type-form" method="POST">
            @csrf
            <input type="hidden" id="edit-type-id" name="id">
            <div class="mb-4">
                <label for="edit-type-name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Tipo de
                    Habitación</label>
                <input type="text" id="edit-type-name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
            <div class="mb-4">
                <label for="edit-type-description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                <textarea id="edit-type-description" name="description" rows="4"
                    class="bg-gray
                    -50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required></textarea>
            </div>
            <div class="mb-4">
                <label for="edit-type-price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                <input type="number" id="edit-type-price" name="price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
            <div class="mb-4">
                <label for="edit-type-max-people"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Máxima cantidad de
                    personas</label>
                <input type="number" id="edit-type-max-people" name="max_people"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar
                Tipo de Habitación</button>
        </form>
    </div>
</div>


{{-- Fin de tipo de habitaciones --}}

<script>
    function openCreateServiceModal() {
        document.getElementById('create-service-modal').classList.remove('hidden');
    }

    function closeCreateServiceModal() {
        document.getElementById('create-service-modal').classList.add('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openCreateTypeModal() {
        document.getElementById('create-type-modal').classList.remove('hidden');
    }

    function openEditServiceModal(id, name, description) {
        document.getElementById('edit-service-modal').classList.remove('hidden');
        document.getElementById('edit-service-id').value = id;
        document.getElementById('edit-service-name').value = name;
        document.getElementById('edit-service-description').value = description;

        // Actualizar action del formulario usando route
        const form = document.getElementById('edit-service-form');
        form.action = "{{ route('admin.servicios.update', '') }}/" + id;
    }

    function openEditTypeModal(id, name, description, price, max_people) {
        document.getElementById('edit-type-modal').classList.remove('hidden');
        document.getElementById('edit-type-id').value = id;
        document.getElementById('edit-type-name').value = name;
        document.getElementById('edit-type-description').value = description;
        document.getElementById('edit-type-price').value = price;
        document.getElementById('edit-type-max-people').value = max_people;

        const form = document.getElementById('edit-type-form');
        form.action = "{{ route('admin.hoteles.type_rooms.update', '') }}/" + id;
    }
</script>
