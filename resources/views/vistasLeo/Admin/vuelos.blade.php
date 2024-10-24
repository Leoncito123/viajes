@extends('vistasLeo.Admin.index')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Viajes</h2>
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
                            Name
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Category
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Brand
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Price
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Stock
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Total Sales
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Status
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
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple iMac</td>
                    <td>Computers</td>
                    <td>Apple</td>
                    <td>$1,299</td>
                    <td>50</td>
                    <td>200</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Apple iMac')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="deleteModal()">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple iPhone</td>
                    <td>Mobile Phones</td>
                    <td>Apple</td>
                    <td>$999</td>
                    <td>120</td>
                    <td>300</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Apple iPhone')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="deleteModal()">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung Galaxy</td>
                    <td>Mobile Phones</td>
                    <td>Samsung</td>
                    <td>$899</td>
                    <td>80</td>
                    <td>150</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal()">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Samsung Galaxy')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Dell XPS 13</td>
                    <td>Computers</td>
                    <td>Dell</td>
                    <td>$1,099</td>
                    <td>30</td>
                    <td>120</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Dell XPS 13')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Dell XPS 13')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">HP Spectre x360</td>
                    <td>Computers</td>
                    <td>HP</td>
                    <td>$1,299</td>
                    <td>25</td>
                    <td>80</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('HP Spectre x360')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('HP Spectre x360')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Google Pixel 6</td>
                    <td>Mobile Phones</td>
                    <td>Google</td>
                    <td>$799</td>
                    <td>100</td>
                    <td>200</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Google Pixel 6')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Google Pixel 6')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Sony WH-1000XM4</td>
                    <td>Headphones</td>
                    <td>Sony</td>
                    <td>$349</td>
                    <td>60</td>
                    <td>150</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Sony WH-1000XM4')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Sony WH-1000XM4')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple AirPods Pro</td>
                    <td>Headphones</td>
                    <td>Apple</td>
                    <td>$249</td>
                    <td>200</td>
                    <td>300</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Apple AirPods Pro')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Apple AirPods Pro')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Asus ROG Zephyrus</td>
                    <td>Computers</td>
                    <td>Asus</td>
                    <td>$1,899</td>
                    <td>15</td>
                    <td>50</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Asus ROG Zephyrus')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Asus ROG Zephyrus')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Microsoft Surface Pro 7
                    </td>
                    <td>Computers</td>
                    <td>Microsoft</td>
                    <td>$899</td>
                    <td>40</td>
                    <td>100</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Microsoft Surface Pro 7')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Microsoft Surface Pro 7')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung QLED TV</td>
                    <td>Televisions</td>
                    <td>Samsung</td>
                    <td>$1,299</td>
                    <td>25</td>
                    <td>70</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Samsung QLED TV')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Samsung QLED TV')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">LG OLED TV</td>
                    <td>Televisions</td>
                    <td>LG</td>
                    <td>$1,499</td>
                    <td>20</td>
                    <td>50</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('LG OLED TV')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('LG OLED TV')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Canon EOS R5</td>
                    <td>Cameras</td>
                    <td>Canon</td>
                    <td>$3,899</td>
                    <td>10</td>
                    <td>30</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Canon EOS R5')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Canon EOS R5')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nikon Z7 II</td>
                    <td>Cameras</td>
                    <td>Nikon</td>
                    <td>$3,299</td>
                    <td>8</td>
                    <td>25</td>
                    <td>In Stock</td>
                    <td>
                        <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="openModal('Nikon Z7 II')">Editar</button>
                        <button class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                            onclick="openModal('Nikon Z7 II')">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium
                            text-gray-900 whitespace-nowrap dark:text-white">
                        PlayStation 5
                    </td>
                    <td>Gaming Consoles</td>
                    <td>Sony</td>
                    <td>$499</td>
                    <td>10</td>
                    <td>500</td>
                    <td>Out of Stock</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Xbox Series X</td>
                    <td>Gaming Consoles</td>
                    <td>Microsoft</td>
                    <td>$499</td>
                    <td>15</td>
                    <td>450</td>
                    <td>Out of Stock</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nintendo Switch</td>
                    <td>Gaming Consoles</td>
                    <td>Nintendo</td>
                    <td>$299</td>
                    <td>40</td>
                    <td>600</td>
                    <td>In Stock</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple MacBook Pro</td>
                    <td>Computers</td>
                    <td>Apple</td>
                    <td>$1,299</td>
                    <td>20</td>
                    <td>100</td>
                    <td>In Stock</td>
                </tr>
            </tbody>
        </table>
    </div>
    <x-leo.admin.vuelos.edit />
    <x-leo.admin.vuelos.remove />
    <x-leo.admin.vuelos.create />
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
