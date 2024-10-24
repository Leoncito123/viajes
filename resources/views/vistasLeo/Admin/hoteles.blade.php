@extends('vistasLeo.Admin.index')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Hoteles</h2>
        <div class="flex items-center">
            <a class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105"
                href="#" onclick="openCreateModal()">
                Crear
            </a>
        </div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <table id="filter-table" class="rounded-lg">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            Nombre
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Ubicación
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Descripción
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Calificación
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Categoria
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Precios
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Hotel Mousai</td>
                    <td>
                        <button class="px-2 py-1 text-xs text-white bg-green-500 rounded hover:bg-green-600">
                            Puerto Vallarta
                        </button>
                    </td>
                    <td>Hotel Adults Only con vista al mar</td>
                    <td>9.4</td>
                    <td>5 estrellas</td>
                    <td>$599/noche</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Hotel Mousai')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="deleteModal()">Eliminar</button>
                    </td>
                </tr>

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Grand Velas Riviera Maya</td>
                    <td>
                        <button class="px-2 py-1 text-xs text-white bg-green-500 rounded hover:bg-green-600"
                            onclick="openLocationModal('Hotel Mousai', 'Puerto Vallarta')">
                            Puerto Vallarta
                        </button>
                    </td>
                    <td>Resort todo incluido frente al mar</td>
                    <td>9.7</td>
                    <td>5 estrellas</td>
                    <td>$899/noche</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Grand Velas Riviera Maya')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="deleteModal()">Eliminar</button>
                    </td>
                </tr>

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Live Aqua Beach Resort</td>
                    <td>
                        <button class="px-2 py-1 text-xs text-white bg-green-500 rounded hover:bg-green-600">
                            Cancún
                        </button>
                    </td>
                    <td>Resort de lujo con spa</td>
                    <td>9.2</td>
                    <td>5 estrellas</td>
                    <td>$749/noche</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Live Aqua Beach Resort')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="deleteModal()">Eliminar</button>
                    </td>
                </tr>

                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Xcaret Arte</td>
                    <td>
                        <button class="px-2 py-1 text-xs text-white bg-green-500 rounded hover:bg-green-600">
                            Riviera Maya
                        </button>
                    </td>
                    <td>Hotel temático con parque acuático</td>
                    <td>9.5</td>
                    <td>5 estrellas</td>
                    <td>$829/noche</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Xcaret Arte')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="deleteModal()">Eliminar</button>
                    </td>
                </tr>

                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Banyan Tree Mayakoba</td>
                    <td>
                        <button class="px-2 py-1 text-xs text-white bg-green-500 rounded hover:bg-green-600">
                            Riviera Maya
                        </button>
                    </td>
                    <td>Resort de lujo con campo de golf</td>
                    <td>9.6</td>
                    <td>5 estrellas</td>
                    <td>$999/noche</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Banyan Tree Mayakoba')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="deleteModal()">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <x-leo.admin.hoteles.edit />
    <x-leo.admin.hoteles.remove />
    <x-leo.admin.hoteles.create />
    <x-leo.admin.hoteles.map />
    <script>
        if (document.getElementById("filter-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#filter-table", {
                tableRender: (_data, table, type) => {
                    if (type === "print") {
                        return table
                    }
                    const tHead = table.childNodes[0]
                    const filterHeaders = {
                        nodeName: "TR",
                        attributes: {
                            class: "search-filtering-row"
                        },
                        childNodes: tHead.childNodes[0].childNodes.map(
                            (_th, index) => ({
                                nodeName: "TH",
                                childNodes: [{
                                    nodeName: "INPUT",
                                    attributes: {
                                        class: "datatable-input",
                                        type: "search",
                                        "data-columns": "[" + index + "]"
                                    }
                                }]
                            })
                        )
                    }
                    tHead.childNodes.push(filterHeaders)
                    return table
                }
            });
        }


        function openModal() {
            document.getElementById('modal-edit').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-edit').classList.add('hidden');
        }

        function deleteModal() {
            document.getElementById('popup-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('popup-modal').classList.add('hidden');
        }

        function openCreateModal() {
            document.getElementById('modal-create').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('modal-create').classList.add('hidden');
        }
    </script>
@endsection
