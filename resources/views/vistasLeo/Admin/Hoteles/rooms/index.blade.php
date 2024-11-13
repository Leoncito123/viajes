<!-- rooms.blade.php -->
@extends('vistasLeo.Admin.index')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Gestionar Habitaciones</h2>

        <!-- Tabla de habitaciones -->
        <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Máx. Personas</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">{{ $room->name }}</td>
                        <td class="px-4 py-2">
                            <input type="number" value="{{ $room->price }}" class="border-gray-300 rounded w-full"
                                onchange="updateRoom({{ $room->id }}, 'price', this.value)">
                        </td>
                        <td class="px-4 py-2">
                            <input type="number" value="{{ $room->max_people }}" class="border-gray-300 rounded w-full"
                                onchange="updateRoom({{ $room->id }}, 'max_people', this.value)">
                        </td>
                        <td class="px-4 py-2">
                            <select onchange="updateRoom({{ $room->id }}, 'id_type_rooms', this.value)"
                                class="border-gray-300 rounded w-full">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $room->id_type_rooms == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-4 py-2">
                            <select onchange="updateRoom({{ $room->id }}, 'status', this.value)"
                                class="border-gray-300 rounded w-full">
                                <option value="disponible" {{ $room->status == 'disponible' ? 'selected' : '' }}>Disponible
                                </option>
                                <option value="ocupado" {{ $room->status == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                            </select>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <button onclick="openEditModal({{ $room->id }})" class="text-blue-600">Editar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de edición para detalles -->
    <div id="editModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Editar Habitación</h2>
                <form id="editRoomForm" onsubmit="saveRoomDetails(event)">
                    <input type="hidden" id="editRoomId">
                    <!-- Campos específicos a editar -->
                    <div class="mb-4">
                        <label class="text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea id="editDescription" class="border-gray-300 rounded w-full" rows="3"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="text-gray-700 dark:text-gray-300">Precio</label>
                        <input type="number" id="editPrice" class="border-gray-300 rounded w-full">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeEditModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
