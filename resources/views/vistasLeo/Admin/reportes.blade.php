@extends('vistasLeo.Admin.index')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

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

        {{-- SECCION DE RESUMENES --}}
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
        </div>

        {{-- TABLA DE VUELOS --}}
        <div class="flex items-center justify-center p-4 rounded-lg mt-10">
            <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Vuelos</h4>
        </div>

        <div class="overflow-x-auto mb-8">
            <table id="fly-table" class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Aerolina</th>
                        <th class="px-4 py-2">Numero de vuelo</th>
                        <th class="px-4 py-2">Fecha de Salida</th>
                        <th class="px-4 py-2">Fecha de Llegada</th>
                        <th class="px-4 py-2">Duración</th>
                        <th class="px-4 py-2">Avión</th>
                        <th class="px-4 py-2">Destino</th>
                        <th class="px-4 py-2">Asientos</th>
                        <th class="px-4 py-2">Asientos vendidos</th>
                        <th class="px-4 py-2">Costos</th>
                        <th class="px-4 py-2">Escalas</th>
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
                                    {{ $cost->cost }} ({{ $cost->classe->type }})@if (!$loop->last)
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
                        <th class="px-4 py-2">Nombre del Hotel</th>
                        <th class="px-4 py-2">Descripción</th>
                        <th class="px-4 py-2">Teléfono</th>
                        <th class="px-4 py-2">Estrellas</th>
                        <th class="px-4 py-2">Distancia al Centro</th>
                        <th class="px-4 py-2">Destino</th>
                        <th class="px-4 py-2">Servicios</th>
                        <th class="px-4 py-2">Habitaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hoteles as $hotel)
                        <tr>
                            <td class="border px-4 py-2">{{ $hotel->name }}</td>
                            <td class="border px-4 py-2">{{ $hotel->description }}</td>
                            <td class="border px-4 py-2">{{ $hotel->phone }}</td>
                            <td class="border px-4 py-2">{{ $hotel->stars }}</td>
                            <td class="border px-4 py-2">{{ $hotel->town_center_distance }}</td>
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

        {{-- TABLAS DE HABITACIONES POR HOTEL --}}
        @foreach ($hoteles as $hotel)
            <div class="flex items-center justify-center p-4 rounded-lg mt-10">
                <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Habitaciones del
                    {{ $hotel->name }}</h4>
            </div>

            <div class="overflow-x-auto mb-8">
                <table id="rooms-table-{{ $hotel->id }}" class="table-auto w-full bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2">Nombre de la Habitación</th>
                            <th class="px-4 py-2">Descripción</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Tipo de Habitación</th>
                            <th class="px-4 py-2">Precio</th>
                            <th class="px-4 py-2">Capacidad Máxima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hotel->rooms as $room)
                            <tr>
                                <td class="border px-4 py-2">{{ $room->name }}</td>
                                <td class="border px-4 py-2">{{ $room->description }}</td>
                                <td class="border px-4 py-2">{{ $room->status ? 'Ocupada' : 'Disponible' }}</td>
                                <td class="border px-4 py-2">{{ $room->type_room->name }}</td>
                                <td class="border px-4 py-2">$ {{ $room->type_room->price }}</td>
                                <td class="border px-4 py-2">{{ $room->type_room->max_people }} personas</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>

    <script>
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

            // Convierte cada tabla de habitaciones a una hoja de trabajo y añádela al libro
            @foreach ($hoteles as $hotel)
                const roomsTable = document.getElementById("rooms-table-{{ $hotel->id }}");
                if (roomsTable) {
                    const roomsSheet = XLSX.utils.table_to_sheet(roomsTable);
                    XLSX.utils.book_append_sheet(workbook, roomsSheet, 'Habitaciones {{ $hotel->name }}');
                }
            @endforeach

            // Exporta el libro de trabajo a un archivo Excel
            XLSX.writeFile(workbook, 'reportes_hoteles_vuelos.xlsx');
        }

        // Exportar a PDF
        function exportToPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.text('Reportes de Hoteles y Vuelos', 20, 20);
            doc.autoTable({
                html: '#hotel-table',
                startY: 30
            });
            doc.autoTable({
                html: '#fly-table',
                startY: doc.lastAutoTable.finalY + 10
            });

            @foreach ($hoteles as $hotel)
                doc.addPage();
                doc.text('Habitaciones del {{ $hotel->name }}', 20, 20);
                doc.autoTable({
                    html: '#rooms-table-{{ $hotel->id }}',
                    startY: 30
                });
            @endforeach

            doc.save('reportes_hoteles_vuelos.pdf');
        }

        // Ejecutar al cargar la página
        document.addEventListener("DOMContentLoaded", updateSummary);
    </script>
@endsection
