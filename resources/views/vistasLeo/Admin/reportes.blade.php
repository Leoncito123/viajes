    @extends('vistasLeo.Admin.index')

    @section('content')
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>


        {{-- HEADER --}}
        <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Reportes</h2>
            <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0 md:space-x-2">
                <a class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:scale-105"
                    href="#" onclick="exportToExcel()">
                    Descargar Excel
                </a>
                <a class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:scale-105"
                    href="#" onclick="exportToPDF()">
                    Descargar PDF
                </a>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- SECCION DE RESUMENES
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="bg-gray-200 p-4 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg">Ingresos Generados</h3>
                    <p id="total-income" class="text-2xl">$0 MXN</p>
                </div>
                <div class="bg-gray-200 p-4 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg">Vuelos Más Reservados</h3>
                    <p id="most-booked-flight" class="text-xl">N/A</p>
                </div>
                <div class="bg-gray-200 p-4 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg">Aerolínea Más Usada</h3>
                    <p id="most-used-airline" class="text-xl">N/A</p>
                </div>
                <div class="bg-gray-200 p-4 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg">Hotel Más Visitado</h3>
                    <p id="most-visited-hotel" class="text-xl">N/A</p>
                </div>
            </div> --}}

            {{-- TABLA DE VUELOS --}}
            <div class="flex items-center justify-center p-4 rounded-lg mt-10">
                <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Vuelos</h4>
            </div>

            <div class="overflow-x-auto mb-8">
                <table id="fly-table" class="table-auto w-full bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2">
                                Aerolina
                                <input type="text" id="filter-airline" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Numero de vuelo
                                <input type="text" id="filter-fly-number" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Fecha de Salida
                                <input type="date" id="filter-departure-date" class="w-full mt-1"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Fecha de Llegada
                                <input type="date" id="filter-arrival-date" class="w-full mt-1" oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Duración
                                <input type="number" id="filter-duration" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Avión
                                <input type="text" id="filter-airplane" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Destino
                                <input type="text" id="filter-destination" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Asientos
                                <input type="number" id="filter-seats" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Asientos vendidos
                            </th>
                            <th class="px-4 py-2">
                                Costos
                                <input type="text" id="filter-costs" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Escalas
                                <input type="text" id="filter-scales" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vuelos as $vuelo)
                            <tr>
                                <td class="border px-4 py-2">{{ $vuelo->airplane->airline->name }}</td>
                                <td class="border px-4 py-2">{{ $vuelo->fly_number }}</td>
                                <td class="border px-4 py-2">{{ $vuelo->depature_date }}</td>
                                <td class="border px-4 py-2">{{ $vuelo->arrival_date }}</td>
                                <td class="border px-4 py-2">{{ $vuelo->fly_duration }} horas</td>
                                <td class="border px-4 py-2">{{ $vuelo->airplane->name }}</td>
                                <td class="border px-4 py-2">{{ $vuelo->destiny->name }}</td>
                                <td class="border px-4 py-2">
                                    @php
                                        $totalSeats = $vuelo->seats->count();
                                    @endphp
                                    <p>Total de Asientos: {{ $totalSeats }}</p>
                                </td>
                                @php
                                    $totalPassengers = 0;
                                    foreach ($vuelo->seats as $seat) {
                                        $totalPassengers += $seat->passengers->count();
                                    }
                                @endphp
                                <td class="border px-4 py-2">{{ $totalPassengers }}</td>
                                <td class="border px-4 py-2">
                                    @foreach ($vuelo->flycosts as $cost)
                                        $ {{ $cost->cost }} ({{ $cost->classe->type }}) @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">
                                    @foreach ($vuelo->scales as $scale)
                                        {{ $scale->destiny->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            {{-- TABLA DE HOTELES --}}
            <div class="flex items-center justify-center p-4 rounded-lg mt-10">
                <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Hoteles</h4>
            </div>

            <div class="overflow-x-auto mb-8">
                <table id="hotel-table" class="table-auto w-full bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2">
                                Nombre del Hotel
                                <input type="text" id="filter-hotel-name" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Descripción
                                <input type="text" id="filter-description" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Teléfono
                                <input type="text" id="filter-phone" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Estrellas
                                <input type="number" id="filter-stars" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Distancia al Centro
                                <input type="number" id="filter-distance" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Destino
                                <input type="text" id="filter-hotel-destination" class="w-full mt-1"
                                    placeholder="Filtrar" oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Servicios
                                <input type="text" id="filter-services" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                            <th class="px-4 py-2">
                                Habitaciones
                                <input type="number" id="filter-rooms" class="w-full mt-1" placeholder="Filtrar"
                                    oninput="applyFilter()">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hoteles as $hotel)
                            <tr>
                                <td class="border px-4 py-2">{{ $hotel->name }}</td>
                                <td class="border px-4 py-2">{{ $hotel->description }}</td>
                                <td class="border px-4 py-2">{{ $hotel->phone }}</td>
                                <td class="border px-4 py-2">{{ $hotel->stars }}</td>
                                <td class="border px-4 py-2">{{ $hotel->town_center_distance }} Km</td>
                                <td class="border px-4 py-2">{{ $hotel->destiny->name }}</td>
                                <td class="border px-4 py-2">
                                    @foreach ($hotel->services as $service)
                                        {{ $service->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">
                                    @php
                                        $totalRooms = $hotel->rooms->count();
                                    @endphp
                                    <p> Total de Habitaciones: {{ $totalRooms }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <script>
            function applyFilter() {
                const filters = {
                    hotel_name: document.getElementById('filter-hotel-name').value,
                    hotel_description: document.getElementById('filter-description').value,
                    hotel_phone: document.getElementById('filter-phone').value,
                    hotel_stars: document.getElementById('filter-stars').value,
                    hotel_distance: document.getElementById('filter-distance').value,
                    hotel_destination: document.getElementById('filter-hotel-destination').value,
                    hotel_services: document.getElementById('filter-services').value,
                    hotel_rooms: document.getElementById('filter-rooms').value,
                    airline: document.getElementById('filter-airline').value,
                    fly_number: document.getElementById('filter-fly-number').value,
                    departure_date: document.getElementById('filter-departure-date').value,
                    arrival_date: document.getElementById('filter-arrival-date').value,
                    duration: document.getElementById('filter-duration').value,
                    airplane: document.getElementById('filter-airplane').value,
                    destination: document.getElementById('filter-destination').value,
                    seats: document.getElementById('filter-seats').value,
                    costs: document.getElementById('filter-costs').value,
                    scales: document.getElementById('filter-scales').value
                };

                fetch('{{ route('reportes.filtrar') }}?' + new URLSearchParams(filters), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        updateTables(data.hoteles, data.vuelos);
                    })
                    .catch(error => console.error('Error:', error));
            }

            function updateTables(hoteles, vuelos) {
                const hotelTableBody = document.querySelector('#hotel-table tbody');
                const flyTableBody = document.querySelector('#fly-table tbody');

                hotelTableBody.innerHTML = '';
                flyTableBody.innerHTML = '';

                hoteles.forEach(hotel => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
            <td class="border px-4 py-2">${hotel.name || 'N/A'}</td>
            <td class="border px-4 py-2">${hotel.description || 'N/A'}</td>
            <td class="border px-4 py-2">${hotel.phone || 'N/A'}</td>
            <td class="border px-4 py-2">${hotel.stars || 'N/A'}</td>
            <td class="border px-4 py-2">${hotel.town_center_distance + ' Km'|| 'N/A'}</td>
            <td class="border px-4 py-2">${hotel.destiny ? hotel.destiny.name : 'N/A'}</td>
            <td class="border px-4 py-2">${hotel.services ? hotel.services.map(service => service.name).join(', ') : 'N/A'}</td>
            <td class="border px-4 py-2">${hotel.rooms ? 'Total de habitaciones: ' + hotel.rooms.length : 'N/A'}</td>
        `;
                    hotelTableBody.appendChild(row);
                });

                vuelos.forEach(vuelo => {
                    const totalSeats = vuelo.seats ? vuelo.seats.length : 0;
                    const totalPassengers = vuelo.seats ? vuelo.seats.reduce((sum, seat) => sum + (seat.passengers ?
                        seat.passengers.length : 0), 0) : 0;
                    const row = document.createElement('tr');
                    row.innerHTML = `
            <td class="border px-4 py-2">${vuelo.airplane && vuelo.airplane.airline ? vuelo.airplane.airline.name : 'N/A'}</td>
            <td class="border px-4 py-2">${vuelo.fly_number || 'N/A'}</td>
            <td class="border px-4 py-2">${vuelo.depature_date || 'N/A'}</td>
            <td class="border px-4 py-2">${vuelo.arrival_date || 'N/A'}</td>
            <td class="border px-4 py-2">${vuelo.fly_duration ? vuelo.fly_duration + ' horas' : 'N/A'}</td>
            <td class="border px-4 py-2">${vuelo.airplane ? vuelo.airplane.name : 'N/A'}</td>
            <td class="border px-4 py-2">${vuelo.destiny ? vuelo.destiny.name : 'N/A'}</td>
            <td class="border px-4 py-2">Total de Asientos: ${totalSeats}</td>
            <td class="border px-4 py-2">${totalPassengers}</td>
            <td class="border px-4 py-2">${vuelo.flycosts ? vuelo.flycosts.map(cost => `$${cost.cost} (${cost.classe ? cost.classe.type : 'N/A'})`).join(', ') : 'N/A'}</td>
            <td class="border px-4 py-2">${vuelo.scales && vuelo.scales.length > 0 ? vuelo.scales.map(scale => {
                const destinyName = scale.destiny ? scale.destiny.name : 'N/A';
                return destinyName;
                }).join(', ') : 'N/A'}
            </td>`;
                    flyTableBody.appendChild(row);
                });
            }

            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', applyFilter);
            });

            // Exportar a Excel
            function exportToExcel() {
                const Tabla_hoteles = document.getElementById("hotel-table");
                const Tabla_vuelos = document.getElementById("fly-table");
                const {
                    XLSX
                } = window;

                // Verifica si las tablas y la librería están disponibles
                if (!Tabla_hoteles || !Tabla_vuelos || !XLSX) {
                    console.error("Elementos o librería XLSX no encontrados.");
                    return;
                }

                // Crea un nuevo libro de trabajo
                const workbook = XLSX.utils.book_new();

                // Convierte la tabla de hoteles a una hoja de trabajo y añádela al libro
                const hotelesSheet = XLSX.utils.table_to_sheet(Tabla_hoteles);
                XLSX.utils.book_append_sheet(workbook, hotelesSheet, 'Hoteles');

                // Convierte la tabla de vuelos a una hoja de trabajo y añádela al libro
                const vuelosSheet = XLSX.utils.table_to_sheet(Tabla_vuelos);
                XLSX.utils.book_append_sheet(workbook, vuelosSheet, 'Vuelos');

                // Obtener las habitaciones desde el servidor y agregar cada una al libro
                const habitacionesData =
                    @json($hoteles); // Obtienes los datos de habitaciones desde el backend (Blade)
                habitacionesData.forEach(hotel => {
                    const roomsData = hotel.rooms;
                    const roomsSheetData = [
                        ["ID", "Nombre", "Descripción", "Tipo de Habitación", "Estado", "Reservaciones", "Precio",
                            "Maximo de personas", "Descripción"
                        ]
                    ];

                    roomsData.forEach(room => {
                        // Accede a las relaciones de cada habitación
                        const typeRoomName = room.type_room ? room.type_room.name :
                            'N/A'; // Nombre del tipo de habitación
                        const Precio = room.type_room ? room.type_room.price : 'N/A'; // Precio de la habitación
                        const Maximo_de_personas = room.type_room ? room.type_room.max_people :
                            'N/A'; // Máximo de personas
                        const Description = room.type_room ? room.type_room.description :
                            'N/A'; // Descripción del tipo de habitación
                        const reservationsCount = room.reservations ? room.reservations.length :
                            0; // Número de reservaciones

                        // Corregido: Añadir la coma que faltaba
                        roomsSheetData.push([
                            room.id,
                            room.name,
                            room.description,
                            typeRoomName,
                            room.status === 1 ? 'Disponible' :
                            'No Disponible', // Suponiendo que 1 es "Disponible"
                            reservationsCount,
                            Precio,
                            Maximo_de_personas,
                            Description, // Aquí agregamos la coma que faltaba
                        ]);
                    });

                    // Crea una hoja de trabajo para cada hotel con las habitaciones
                    const roomsSheet = XLSX.utils.aoa_to_sheet(roomsSheetData);
                    XLSX.utils.book_append_sheet(workbook, roomsSheet, 'Habitaciones ' + hotel.name);
                });

                // Exporta el libro de trabajo a un archivo Excel
                XLSX.writeFile(workbook, 'reportes_hoteles_vuelos.xlsx');
            }

            // Exportar a PDF
            function exportToPDF() {
                const hotelTable = document.getElementById("hotel-table");
                const flyTable = document.getElementById("fly-table");

                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Verifica si las tablas están disponibles
                if (!hotelTable || !flyTable) {
                    console.error("No se encontraron las tablas para exportar.");
                    return;
                }

                // Agregar tabla de Hoteles
                doc.text("Reporte de Hoteles", 14, 15); // Título del reporte
                doc.autoTable({
                    html: hotelTable,
                    startY: 20, // Inicia debajo del título
                    theme: 'grid',
                    styles: {
                        fontSize: 8
                    } // Ajusta el tamaño de fuente
                });

                // Salto de página para tabla de vuelos
                doc.addPage();
                doc.text("Reporte de Vuelos", 14, 15);
                doc.autoTable({
                    html: flyTable,
                    startY: 20,
                    theme: 'grid',
                    styles: {
                        fontSize: 8
                    }
                });

                // Generar reporte adicional de habitaciones
                const hotelsData = @json($hoteles); // Datos de backend
                hotelsData.forEach((hotel, index) => {
                    const roomsData = hotel.rooms;

                    if (roomsData.length > 0) {
                        // Agrega una nueva página por cada hotel
                        doc.addPage();
                        doc.text(`Habitaciones del Hotel: ${hotel.name}`, 14, 15);

                        // Prepara los datos de habitaciones para la tabla
                        const roomsTableData = roomsData.map(room => [
                            room.name,
                            room.description,
                            room.type_room ? room.type_room.name : 'N/A',
                            room.type_room ? `$${room.type_room.price}` : 'N/A',
                            room.type_room ? room.type_room.max_people : 'N/A',
                            room.status === 1 ? "Disponible" : "No Disponible"
                        ]);

                        // Genera la tabla de habitaciones
                        doc.autoTable({
                            head: [
                                ["Nombre", "Descripción", "Tipo", "Precio", "Capacidad Máx.", "Estado"]
                            ],
                            body: roomsTableData,
                            startY: 25,
                            theme: 'grid',
                            styles: {
                                fontSize: 8
                            }
                        });
                    }
                });

                // Guardar el PDF
                doc.save("Reporte.pdf");
            }
        </script>
    @endsection
