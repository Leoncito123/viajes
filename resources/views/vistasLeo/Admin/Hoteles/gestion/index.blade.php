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
                                                    <a href=""
                                                        class="p-2 rounded-lg font-semibold text-white bg-blue-500">Editar</a>
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
    </div>
</div>

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

<script>
    function openCreateServiceModal() {
        document.getElementById('create-service-modal').classList.remove('hidden');
    }

    function closeCreateServiceModal() {
        document.getElementById('create-service-modal').classList.add('hidden');
    }
</script>
