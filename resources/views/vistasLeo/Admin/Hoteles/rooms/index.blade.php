@extends('vistasLeo.Admin.index')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Clasificar Habitaciones</h2>

        <!-- Lista simplificada de habitaciones con selección de tipo -->
        <div class="space-y-4">
            @foreach ($rooms as $room)
                <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <span class="text-lg text-gray-900 dark:text-white">{{ $room->name }}</span>
                    <select onchange="updateRoomType({{ $room->id }}, this.value)" class="border-gray-300 rounded w-1/2">
                        <option value="" disabled selected>Selecciona tipo</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ $room->id_type_rooms == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function updateRoomType(roomId, typeId) {
            fetch('/admin/hoteles/rooms/edit/' + roomId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        roomId: roomId,
                        typeId: typeId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert('Hubo un error al actualizar la habitación.');
                    }
                });
        }
    </script>
@endsection
