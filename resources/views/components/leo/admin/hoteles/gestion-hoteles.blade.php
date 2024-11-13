<!-- drawer init and toggle -->
<div>
    <!-- Botón para abrir el drawer -->
    <button class="text-white bg-indigo-500 p-2 rounded-lg" type="button" data-drawer-show="drawer-example">
        Gestión del Vuelo
    </button>

    @dump($servicios)

    <!-- drawer component -->
    <div id="drawer-example"
        class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-full lg:w-11/12 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label">
        <div class="flex justify-end text-center mb-4"> <!-- Cambié aquí para usar flex -->
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
                fetch('/delete/servicio/' + servicio, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Eliminado!',
                                'El servicio ha sido eliminado.',
                                'success'
                            )
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'Hubo un problema al eliminar el hotel.',
                            'error'
                        );
                    });
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
                        <button class="p-2 rounded-lg bg-blue-500 text-white">Crear</button>
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
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($servicios) == 0)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                                colspan="2">
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
                                                    <a href=""
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
    </div>
