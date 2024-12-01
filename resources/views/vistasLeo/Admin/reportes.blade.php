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

        {{-- FILTROS PARA LA PRIMERA TABLA --}}

        <div class="flex items-center justify-center p-4 rounded-lg mt-10">
            <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Vuelos</h4>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" id="filter-date" placeholder="Filtrar por fecha"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-destination" placeholder="Filtrar por destino"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-airline" placeholder="Filtrar por aerolínea"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-price" placeholder="Filtrar por precio"
                class="border p-2 rounded w-full md:w-1/4">
            <button onclick="applyFilters()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-0 rounded">Aplicar
                Filtros</button>
        </div>

        {{-- PRIMERA TABLA: RESERVAS --}}
        <div class="overflow-x-auto mb-8">
            <table id="report-table" class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Destino</th>
                        <th class="px-4 py-2">Aerolínea</th>
                        <th class="px-4 py-2">Cliente</th>
                        <th class="px-4 py-2">Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">2024-10-01</td>
                        <td class="border px-4 py-2">CDMX</td>
                        <td class="border px-4 py-2">Aeromexico</td>
                        <td class="border px-4 py-2">Juan Pérez</td>
                        <td class="border px-4 py-2">$2,000</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2024-10-05</td>
                        <td class="border px-4 py-2">Cancún</td>
                        <td class="border px-4 py-2">Volaris</td>
                        <td class="border px-4 py-2">Ana García</td>
                        <td class="border px-4 py-2">$1,800</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2024-10-07</td>
                        <td class="border px-4 py-2">Monterrey</td>
                        <td class="border px-4 py-2">Interjet</td>
                        <td class="border px-4 py-2">Luis Martínez</td>
                        <td class="border px-4 py-2">$2,200</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2024-10-10</td>
                        <td class="border px-4 py-2">Guadalajara</td>
                        <td class="border px-4 py-2">Aeromexico</td>
                        <td class="border px-4 py-2">María López</td>
                        <td class="border px-4 py-2">$1,900</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2024-10-20</td>
                        <td class="border px-4 py-2">CDMX</td>
                        <td class="border px-4 py-2">Aeromexico</td>
                        <td class="border px-4 py-2">Luis Gomez</td>
                        <td class="border px-4 py-2">$1,900</td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-center p-4 rounded-lg ">
            <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Aerolinas</h4>
        </div>

        {{-- FILTROS PARA LA SEGUNDA TABLA --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" id="filter-airplane" placeholder="Filtrar por avión"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-seats" placeholder="Filtrar por asientos vendidos"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-airline-2" placeholder="Filtrar por aerolínea"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-class" placeholder="Filtrar por clase"
                class="border p-2 rounded w-full md:w-1/4">
            <button onclick="applyFiltersAirplane()"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-0 rounded">Aplicar Filtros</button>
        </div>

        {{-- SEGUNDA TABLA: AVIONES --}}
        <div class="overflow-x-auto mb-8">
            <table id="airplane-table" class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Avión</th>
                        <th class="px-4 py-2">Asientos Vendidos</th>
                        <th class="px-4 py-2">Aerolínea</th>
                        <th class="px-4 py-2">Clase</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Boeing 737</td>
                        <td class="border px-4 py-2">150</td>
                        <td class="border px-4 py-2">Aeromexico</td>
                        <td class="border px-4 py-2">Económica</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Airbus A320</td>
                        <td class="border px-4 py-2">120</td>
                        <td class="border px-4 py-2">Volaris</td>
                        <td class="border px-4 py-2">Económica</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Boeing 777</td>
                        <td class="border px-4 py-2">180</td>
                        <td class="border px-4 py-2">Interjet</td>
                        <td class="border px-4 py-2">Primera</td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-center p-4 rounded-lg ">
            <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Hoteles</h4>
        </div>

        {{-- FILTROS PARA LA TERCERA TABLA --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" id="filter-destiny" placeholder="Filtrar por cuidad"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-hotel" placeholder="Filtrar por hotel"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-services" placeholder="Filtrar por servicios"
                class="border p-2 rounded w-full md:w-1/4">
            <input type="text" id="filter-stars" placeholder="Filtrar por estrellas"
                class="border p-2 rounded w-full md:w-1/4">
            <button onclick="applyFiltersHotel()"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-0 rounded">Aplicar Filtros</button>
        </div>

        {{-- TERCERA TABLA: HOTELES --}}
        <div class="overflow-x-auto mb-8">
            <table id="hotel-table" class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Ciudad</th>
                        <th class="px-4 py-2">Hotel</th>
                        <th class="px-4 py-2">Servicios</th>
                        <th class="px-4 py-2">Estrellas</th>
                        <th class="px-4 py-2">Opiniones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Monterrey</td>
                        <td class="border px-4 py-2">Plaza</td>
                        <td class="border px-4 py-2">Wi-Fi, Desayuno</td>
                        <td class="border px-4 py-2">4</td>
                        <td class="border px-4 py-2">Excelente</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">CDMX</td>
                        <td class="border px-4 py-2">Maravilla</td>
                        <td class="border px-4 py-2">Piscina, Spa</td>
                        <td class="border px-4 py-2">5</td>
                        <td class="border px-4 py-2">Muy Bueno</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Guadalajara</td>
                        <td class="border px-4 py-2">Pacifico</td>
                        <td class="border px-4 py-2">Gimnasio, Restaurante</td>
                        <td class="border px-4 py-2">3</td>
                        <td class="border px-4 py-2">Bueno</td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>

        {{-- FILTROS PARA LA CUARTA TABLA --}}

        <div class="flex items-center justify-center p-4 rounded-lg mt-10">
            <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Seleccionar Hotel</h4>
        </div>

        <div class="flex justify-center mb-4">
            <select id="hotel-select" class="border p-2 rounded w-full md:w-1/4" onchange="showRoomTable()">
                <option value="">Seleccione un hotel</option>
                <option value="hotel1">Plaza</option>
                <option value="hotel2">Maravilla</option>
                <option value="hotel3">Pacifico</option>
            </select>
        </div>

        <div id="room-table-container" class="hidden">
            <div class="flex items-center justify-center p-4 rounded-lg mt-10">
                <h4 class="text-center text-xl font-bold text-gray-900 dark:text-white">Habitaciones</h4>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0 md:space-x-2">
                <input type="text" id="filter-room" placeholder="Filtrar por habitación"
                    class="border p-2 rounded w-full md:w-1/4">
                <input type="text" id="filter-price-2" placeholder="Filtrar por precio"
                    class="border p-2 rounded w-full md:w-1/4">
                <input type="text" id="filter-services-2" placeholder="Filtrar por servicios"
                    class="border p-2 rounded w-full md:w-1/4">
                <input type="text" id="filter-capacity" placeholder="Filtrar por capacidad"
                    class="border p-2 rounded w-full md:w-1/4">
                <button onclick="applyFiltersRoom()"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-0 rounded">Aplicar Filtros</button>
            </div>

            {{-- CUARTA TABLA: HABITACIONES --}}
            <table id="room-table" class="min-w-full bg-white dark:bg-gray-800">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2">Nombre de la Habitación</th>
                        <th class="py-2">Precio</th>
                        <th class="py-2">Descripción</th>
                        <th class="py-2">Capacidad Máxima</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Suite del Lago</td>
                        <td class="border px-4 py-2">$150.00</td>
                        <td class="border px-4 py-2">Amplia suite con vista al lago, incluye minibar y jacuzzi.</td>
                        <td class="border px-4 py-2">2</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Habitación Familiar</td>
                        <td class="border px-4 py-2">$100.00</td>
                        <td class="border px-4 py-2">Habitación ideal para familias, con dos camas matrimoniales y área de
                            juegos para niños.</td>
                        <td class="border px-4 py-2">4</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Habitación Ejecutiva</td>
                        <td class="border px-4 py-2">$120.00</td>
                        <td class="border px-4 py-2">Habitación con escritorio, ideal para viajeros de negocios, incluye
                            acceso a internet.</td>
                        <td class="border px-4 py-2">1</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Cabaña Romántica</td>
                        <td class="border px-4 py-2">$180.00</td>
                        <td class="border px-4 py-2">Cabaña privada en medio de la naturaleza, con chimenea y balcón.</td>
                        <td class="border px-4 py-2">2</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Habitación Doble</td>
                        <td class="border px-4 py-2">$80.00</td>
                        <td class="border px-4 py-2">Habitación cómoda con dos camas individuales, perfecta para amigos o
                            colegas.</td>
                        <td class="border px-4 py-2">2</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


    <script>
        // Exportar a Excel
        function exportToExcel() {
            const Tabla_reportes = document.getElementById("report-table");
            const Tabla_aviones = document.getElementById("airplane-table");
            const {
                XLSX
            } = window;

            // Verifica si las tablas y la librería están disponibles
            if (!Tabla_reportes || !Tabla_aviones || !XLSX) {
                console.error("Elementos o librería XLSX no encontrados.");
                return;
            }

            // Crea un nuevo libro de trabajo
            const workbook = XLSX.utils.book_new();

            // Convierte la tabla de reportes a una hoja de trabajo y añádela al libro
            const reportesSheet = XLSX.utils.table_to_sheet(Tabla_reportes);
            XLSX.utils.book_append_sheet(workbook, reportesSheet, 'Reportes');

            // Convierte la tabla de aviones a una hoja de trabajo y añádela al libro
            const avionesSheet = XLSX.utils.table_to_sheet(Tabla_aviones);
            XLSX.utils.book_append_sheet(workbook, avionesSheet, 'Aviones');

            // Exporta el libro de trabajo a un archivo Excel
            XLSX.writeFile(workbook, 'reportes_reservas.xlsx');
        }

        // Exportar a PDF
        function exportToPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.text('Reportes de Reservas', 20, 20);
            doc.autoTable({
                html: '#report-table',
                startY: 30
            });
            doc.save('reportes_reservas.pdf');
        }

        // Aplicar Filtros para la Primera Tabla
        function applyFilters() {
            const filterDate = document.getElementById("filter-date").value.toLowerCase();
            const filterDestination = document.getElementById("filter-destination").value.toLowerCase();
            const filterAirline = document.getElementById("filter-airline").value.toLowerCase();
            const filterPrice = document.getElementById("filter-price").value.toLowerCase();

            const table = document.getElementById("report-table");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { // Skip header row
                const cells = rows[i].getElementsByTagName("td");
                const date = cells[0].textContent.toLowerCase();
                const destination = cells[1].textContent.toLowerCase();
                const airline = cells[2].textContent.toLowerCase();
                const price = cells[4].textContent.replace(/[^0-9.-]+/g, "").toLowerCase(); // Remove currency symbol

                const dateMatch = date.includes(filterDate);
                const destinationMatch = destination.includes(filterDestination);
                const airlineMatch = airline.includes(filterAirline);
                const priceMatch = price.includes(filterPrice);

                // Show row if it matches all filters, otherwise hide it
                if (dateMatch && destinationMatch && airlineMatch && (filterPrice === "" || price <= filterPrice)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }

        }


        // Aplicar Filtros para la Segunda Tabla
        function applyFiltersAirplane() {
            const filterAirplane = document.getElementById("filter-airplane").value.toLowerCase();
            const filterSeats = document.getElementById("filter-seats").value.toLowerCase();
            const filterAirline2 = document.getElementById("filter-airline-2").value.toLowerCase();
            const filterClass = document.getElementById("filter-class").value.toLowerCase();
            const table = document.getElementById("airplane-table").getElementsByTagName("tbody")[0];
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const airplaneCell = rows[i].getElementsByTagName("td")[0].textContent.toLowerCase();
                const seatsCell = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
                const airlineCell = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
                const classCell = rows[i].getElementsByTagName("td")[3].textContent.toLowerCase();

                rows[i].style.display =
                    (airplaneCell.includes(filterAirplane) &&
                        seatsCell.includes(filterSeats) &&
                        airlineCell.includes(filterAirline2) &&
                        classCell.includes(filterClass)) ?
                    "" :
                    "none";
            }


        }

        // Aplicar Filtros para la Tercera Tabla (Hoteles)
        function applyFiltersHotel() {
            const filterCity = document.getElementById("filter-destiny").value.toLowerCase();
            const filterHotel = document.getElementById("filter-hotel").value.toLowerCase();
            const filterServices = document.getElementById("filter-services").value.toLowerCase();
            const filterStars = document.getElementById("filter-stars").value;

            const hotelTable = document.getElementById("hotel-table");
            const rows = hotelTable.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const cityCell = rows[i].getElementsByTagName("td")[0].textContent.toLowerCase();
                const hotelCell = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
                const servicesCell = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
                const starsCell = rows[i].getElementsByTagName("td")[3].textContent;

                // Filtrar filas según criterios
                const isCityMatch = cityCell.includes(filterCity);
                const isHotelMatch = hotelCell.includes(filterHotel);
                const isServicesMatch = servicesCell.includes(filterServices);
                const isStarsMatch = filterStars ? starsCell === filterStars : true;

                // Muestra/oculta la fila según los filtros
                if (isCityMatch && isHotelMatch && isServicesMatch && isStarsMatch) {
                    rows[i].style.display = ""; // Muestra la fila
                } else {
                    rows[i].style.display = "none"; // Oculta la fila
                }
            }
        }

        function showRoomTable() {
            const hotelSelect = document.getElementById("hotel-select").value;
            const roomTableContainer = document.getElementById("room-table-container");

            if (hotelSelect) {
                roomTableContainer.classList.remove("hidden");
                // Aquí puedes agregar lógica para cargar dinámicamente las habitaciones del hotel seleccionado
            } else {
                roomTableContainer.classList.add("hidden");
            }
        }

        function applyFiltersRoom() {
            const filterRoom = document.getElementById("filter-room").value.toLowerCase();
            const filterPrice = document.getElementById("filter-price-2").value.toLowerCase();
            const filterServices = document.getElementById("filter-services-2").value.toLowerCase();
            const filterCapacity = document.getElementById("filter-capacity").value.toLowerCase();
            const table = document.getElementById("room-table").getElementsByTagName("tbody")[0];
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const roomCell = rows[i].getElementsByTagName("td")[0].textContent.toLowerCase();
                const priceCell = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
                const servicesCell = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
                const capacityCell = rows[i].getElementsByTagName("td")[3].textContent.toLowerCase();

                rows[i].style.display =
                    (roomCell.includes(filterRoom) &&
                        priceCell.includes(filterPrice) &&
                        servicesCell.includes(filterServices) &&
                        capacityCell.includes(filterCapacity)) ?
                    "" :
                    "none";
            }
        }

        // Aplicar Filtros para la Tercera Tabla
        function updateSummary() {
            // Tabla vuelos
            const rows = document.getElementById("report-table").getElementsByTagName("tbody")[0].getElementsByTagName(
                "tr");
            let totalIncome = 0;
            const destinations = {};
            const airlines = {};
            const hotels = {}; // Inicializar aquí

            for (let i = 0; i < rows.length; i++) {
                const incomeCell = rows[i].getElementsByTagName("td")[4];
                const destinationCell = rows[i].getElementsByTagName("td")[1].textContent;
                const airlineCell = rows[i].getElementsByTagName("td")[2].textContent;
                const hotelCell = rows[i].getElementsByTagName("td")[3].textContent; // Columna del hotel

                const income = parseFloat(incomeCell.textContent.replace('$', '').replace(',', ''));
                if (!isNaN(income)) {
                    totalIncome += income;
                }

                // Contar destinos
                destinations[destinationCell] = (destinations[destinationCell] || 0) + 1;

                // Contar aerolíneas
                airlines[airlineCell] = (airlines[airlineCell] || 0) + 1;

                // Contar hoteles
                hotels[hotelCell] = (hotels[hotelCell] || 0) + 1; // Contar hoteles aquí
            }

            // Tabla hoteles
            const hotelRows = document.getElementById("hotel-table").getElementsByTagName("tbody")[0].getElementsByTagName(
                "tr");
            for (let i = 0; i < hotelRows.length; i++) {
                const hotelCell = hotelRows[i].getElementsByTagName("td")[0].textContent; // Columna del hotel
                hotels[hotelCell] = (hotels[hotelCell] || 0) + 1; // Contar hoteles aquí también
            }

            // Encontrar el hotel más visitado
            const mostVisitedHotel = Object.keys(hotels).reduce((a, b) => hotels[a] > hotels[b] ? a : b, 'N/A');
            document.getElementById("most-visited-hotel").textContent = mostVisitedHotel;

            // Actualizar ingresos totales
            document.getElementById("total-income").textContent = `$${totalIncome.toLocaleString()} MXN`;

            // Encontrar el destino más reservado
            const mostBookedFlight = Object.keys(destinations).reduce((a, b) => destinations[a] > destinations[b] ? a : b,
                'N/A');
            document.getElementById("most-booked-flight").textContent = mostBookedFlight;

            // Encontrar la aerolínea más utilizada
            const mostUsedAirline = Object.keys(airlines).reduce((a, b) => airlines[a] > airlines[b] ? a : b, 'N/A');
            document.getElementById("most-used-airline").textContent = mostUsedAirline;
        }

        // Ejecutar al cargar la página
        document.addEventListener("DOMContentLoaded", updateSummary);
    </script>
@endsection
