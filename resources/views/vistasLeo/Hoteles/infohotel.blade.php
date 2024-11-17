<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hotel') }} {{ $hotel->name }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Gracias por tu comentario</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif



    {{-- Mostrar errores --}}
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <p class="font-bold">Error</p>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="relative w-full max-w-7xl">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Carrusel -->
            <div class="p-4 space-y-4">
                <div id="carouselExample" class="relative" data-carousel="static">
                    <div class="relative w-full h-80 overflow-hidden rounded-lg">
                        @foreach ($hotel->pictures as $picture)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="{{ asset('storage/' . $picture->name) }}"
                                    class="block w-full h-full object-cover" alt="Hotel Image">
                            </div>
                        @endforeach
                    </div>
                    <!-- Controles -->
                    <button class="absolute bg-black rounded-full opacity-50 top-0 left-0 z-30 p-2 focus:outline-none"
                        data-carousel-prev>
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="absolute bg-black opacity-50 rounded-full top-0 right-0 z-30 p-2 focus:outline-none"
                        data-carousel-next>
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                {{-- Mapa --}}
                <div class="h-96 rounded-lg" id="map">
                    <x-leo.hoteles.hotel-mapa longitude='{{ $hotel->destiny->longitude }}'
                        latitude='{{ $hotel->destiny->latitude }}' />
                </div>

                <!-- Servicios -->
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Servicios</h1>
                <div class="flex flex-wrap gap-2">
                    @foreach ($hotel->services as $service)
                        <span class="px-3 py-1 bg-gray-200 rounded-lg dark:bg-gray-800 text-sm dark:text-gray-300">
                            {{ $service->name }}: {{ $service->description }}
                        </span>
                    @endforeach
                </div>

                @if (session('message'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" id="alertReservation">
                        <p class="font-bold">Error</p>
                        <p>{{ session('message') }}</p>
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById('alertReservation').scrollIntoView({
                                behavior: 'smooth'
                            });
                        }, );
                    </script>
                @endif

                <!-- Selección dinámica de habitaciones -->
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Selecciona una habitación</h2>
                <div id="rooms-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($hotel->rooms as $room)
                        @if ($room->status == 0)
                            <div id="room-{{ $room->id }}" class="border rounded-lg p-4 bg-white dark:bg-gray-800">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">{{ $room->name }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Capacidad:
                                    {{ $room->type_room ? $room->type_room->max_people ?? 'N/A' : 'Sin información' }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Precio:
                                    ${{ $room->type_room ? $room->type_room->price ?? 'N/A' : 'Sin información' }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Descripcion de la habitacion:
                                    {{ $room->type_room ? $room->type_room->description ?? 'N/A' : 'Sin información' }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tipo de habitacion:
                                    {{ $room->type_room ? $room->type_room->name ?? 'N/A' : 'Sin información' }}</p>
                                <button type="button" id="select-room-{{ $room->id }}"
                                    class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                                    onclick="selectRoom({{ $room->id }})">
                                    Seleccionar
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Formulario -->
                <div class="mt-6">
                    <!-- Formulario de reservación -->
                    <form action="{{ route('reservation.hotel.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-4">
                            <!-- Cantidad de adultos -->
                            <div class="flex items-center gap-4">
                                <label for="cant_adults" class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                    Adultos:
                                </label>
                                <div class="flex items-center">
                                    <button type="button" id="decrement-adults"
                                        class="bg-gray-200 dark:bg-gray-700 p-2 rounded-l-lg text-gray-700 dark:text-gray-300">-</button>
                                    <input type="number" id="cant_adults" name="cant_adults"
                                        value="{{ old('cant_adults') ?? 0 }}" min="0"
                                        class="w-16 text-center bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-none text-gray-900 dark:text-gray-200">
                                    <button type="button" id="increment-adults"
                                        class="bg-gray-200 dark:bg-gray-700 p-2 rounded-r-lg text-gray-700 dark:text-gray-300">+</button>
                                </div>
                            </div>
                            <!-- Cantidad de niños -->
                            <div class="flex items-center gap-4">
                                <label for="cant_infants" class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                    Niños:
                                </label>
                                <div class="flex items-center">
                                    <button type="button" id="decrement-kids"
                                        class="bg-gray-200 dark:bg-gray-700 p-2 rounded-l-lg text-gray-700 dark:text-gray-300">-</button>
                                    <input type="number" id="cant_infants" name="cant_infants"
                                        value="{{ old('cant_infants') ?? 0 }}" min="0"
                                        class="w-16 text-center bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-none text-gray-900 dark:text-gray-200">
                                    <button type="button" id="increment-kids"
                                        class="bg-gray-200 dark:bg-gray-700 p-2 rounded-r-lg text-gray-700 dark:text-gray-300">+</button>
                                </div>
                            </div>

                            <div hidden>
                                <input type="hidden" id="status_payment" name="status_payment" value="0"
                                    class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                            </div>

                            <!-- Fechas -->
                            <div>
                                <label for="check_in"
                                    class="block text-sm font-medium text-gray-900 dark:text-gray-200">Fecha de
                                    Check-in:</label>
                                <input type="date" id="check_in" name="check_in" value="{{ old('check_in') }}"
                                    class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                            </div>
                            <div>
                                <label for="check_out" value="{{ old('check_out') }}"
                                    class="block text-sm font-medium text-gray-900 dark:text-gray-200">Fecha de
                                    Check-out:</label>
                                <input type="date" id="check_out" name="check_out"
                                    class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                            </div>
                            <!-- Campo oculto para ID de habitación -->
                            <input type="hidden" id="id_room" name="id_room" value="{{ old('id_room') }}">

                            <!-- Botón de reservar para alguien más -->
                            <div class="flex justify-end">
                                <button type="button" id="reserve-for-others"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                    Reservar para alguien más
                                </button>
                            </div>

                            <!-- Inputs adicionales -->
                            <div id="additional-fields" class="hidden space-y-4">
                                <div>
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-900 dark:text-gray-200">Nombre</label>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                        class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                                </div>
                                <div>
                                    <label for="last_names"
                                        class="block text-sm font-medium text-gray-900 dark:text-gray-200">Apellidos</label>
                                    <input type="text" id="last_names" name="last_names"
                                        value="{{ $user->last_name }}"
                                        class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                                </div>
                                <div>
                                    <label for="birthdate"
                                        class="block text-sm font-medium text-gray-900 dark:text-gray-200">Fecha de
                                        Nacimiento</label>
                                    <input type="date" id="birthdate" name="birthdate"
                                        value="{{ $user->birthdate }}"
                                        class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                                </div>
                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-900 dark:text-gray-200">Correo
                                        Electrónico</label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                                        class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                                </div>
                                <div>
                                    <label for="phone"
                                        class="block text-sm font-medium text-gray-900 dark:text-gray-200">Teléfono</label>
                                    <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                                        class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                                </div>
                                <div>
                                    <label for="id_gender"
                                        class="block text-sm font-medium text-gray-900 dark:text-gray-200">Género</label>
                                    <select id="id_gender" name="id_gender"
                                        class="w-full mt-1 p-2 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded-md text-gray-900 dark:text-gray-200">
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}"
                                                {{ $user->id_gender == $gender->id ? 'selected' : '' }}>
                                                {{ $gender->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Botón de envío -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Reservar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- Comentarios --}}
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Comentarios</h1>
                <x-leo.hoteles.comentarios :id_hotel="$hotel->id" :coments="$hotel->opinions" />
            </div>
        </div>

        <script>
            document.getElementById('reserve-for-others').addEventListener('click', function() {
                const additionalFields = document.getElementById('additional-fields');
                additionalFields.classList.toggle('hidden');
            });

            document.getElementById('decrement-adults').addEventListener('click', function() {
                const input = document.getElementById('cant_adults');
                let value = parseInt(input.value);
                if (value > 0) {
                    value--;
                    input.value = value;
                }
            });

            document.getElementById('increment-adults').addEventListener('click', function() {
                const input = document.getElementById('cant_adults');
                let value = parseInt(input.value);
                value++;
                input.value = value;
            });

            document.getElementById('decrement-kids').addEventListener('click', function() {
                const input = document.getElementById('cant_infants');
                let value = parseInt(input.value);
                if (value > 0) {
                    value--;
                    input.value = value;
                }
            });

            document.getElementById('increment-kids').addEventListener('click', function() {
                const input = document.getElementById('cant_infants');
                let value = parseInt(input.value);
                value++;
                input.value = value;
            });

            function selectRoom(roomId) {
                document.getElementById('id_room').value = roomId;
                const rooms = document.querySelectorAll('[id^="room-"]');
                rooms.forEach(room => {
                    if (room.id !== `room-${roomId}`) {
                        room.classList.add('hidden');
                    }
                });
                // Eliminar cualquier botón de seleccionar selección existente
                const selectButtons = document.querySelectorAll('[id^="select-room-"]');
                selectButtons.forEach(button => {
                    button.remove();
                });

                // Mostrar botón para cancelar selección
                const cancelButton = document.createElement('button');
                cancelButton.id = 'cancel-selection';
                cancelButton.className = 'mt-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700';
                cancelButton.textContent = 'Cancelar selección';
                cancelButton.onclick = cancelSelection;
                document.getElementById(`room-${roomId}`).appendChild(cancelButton);
            }

            function cancelSelection() {
                document.getElementById('id_room').value = '';
                const rooms = document.querySelectorAll('[id^="room-"]');
                rooms.forEach(room => {
                    room.classList.remove('hidden');
                });
                // Eliminar botón de cancelar selección
                const cancelButton = document.getElementById('cancel-selection');
                if (cancelButton) {
                    cancelButton.remove();
                }
                // Volver a agregar botones de seleccionar
                rooms.forEach(room => {
                    const roomId = room.id.split('-')[1];
                    const selectButton = document.createElement('button');
                    selectButton.id = `select-room-${roomId}`;
                    selectButton.className = 'mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700';
                    selectButton.textContent = 'Seleccionar';
                    selectButton.onclick = function() {
                        selectRoom(roomId);
                    };
                    room.appendChild(selectButton);
                });
            }

            // Ejecutar cuando carga la página
            document.addEventListener('DOMContentLoaded', function() {
                const oldRoomId = "{{ old('id_room') }}";
                if (oldRoomId) {
                    selectRoom(oldRoomId);
                }
            });
        </script>
</x-app-layout>
