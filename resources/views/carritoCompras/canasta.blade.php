<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-">
        <div class="max-w-10xl ">
            <div class="bg-white  dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 dark:text-gray-100">
                    <div>
                        <p class="p-2 font-semibold text-xl bg-indigo-500 text-white rounded-lg">Destalles de Mi Vuelo</p>
                    </div>

                    <div class="w-full">
                        <div class="mt-4 text-right">
                            <p class="text-xl lg:text-4xl md:text-2xl font-semibold">Costo Total: <span class="text-green-500">${{$costoTotal}}</span></p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-4">
                            <!-- Verificar si no hay vuelos -->
                            @if($compras->isEmpty())
                            <p class="text-lg font-semibold text-red-500">No hay vuelos ni reservaciones por pagar.</p>
                        @else
                            @foreach($compras as $compra)
                                @if($compra->passenger_flies && $compra->passenger_flies->passenger)
                                    <!-- Card de vuelo -->
                                    <div class="p-2 px-4 mb-6 w-full border rounded-lg border-indigo-400 hover:bg-indigo-500 hover:text-white flex">
                                        <div class="p-2 px-4 mb-6 w-full border rounded-lg border-indigo-400 hover:bg-indigo-500 hover:text-white flex">
                                            <div class="flex border-r hover:border-white border-indigo-500 items-center mr-4">
                                                <svg class="w-24 h-24 mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z"/>
                                                </svg>
                                            </div>
                                            <div class="w-full">
                                                <p class="text-lg font-normal">Pasajero: <span class="font-semibold">{{ $compra->passenger_flies->passenger->name }} {{ $compra->passenger_flies->passenger->last_name }}</span></p>
                                                <p class="text-lg font-normal">Número de vuelo: <span class="font-semibold">{{ $compra->passenger_flies->fly->fly_number }}</span></p>
                                                <p class="text-lg font-normal">Fecha de Salida: <span class="font-semibold">{{ $compra->passenger_flies->fly->depature_date }}</span></p>
                                                <p class="text-lg font-normal">Fecha de Llegada: <span class="font-semibold">{{ $compra->passenger_flies->fly->arrival_date }}</span></p>
                                                <p class="text-lg font-normal">Horas de vuelo: <span class="font-semibold">{{ $compra->passenger_flies->fly->fly_duration }}</span></p>
                                                <p class="text-lg font-normal">Costo de vuelo: <span class="font-semibold">{{ $compra->passenger_flies->fly->flyCosts->first()->cost }}</span></p>

                                                <form action="{{ route('delete.buy', $compra->id) }}" method="POST" class="w-full flex" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reservación?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-white bg-red-500 p-2 text-right rounded-lg hover:bg-red-700 font-semibold mt-2">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                @elseif($compra->reservations->isNotEmpty())
                                    @foreach($compra->reservations as $reservation)
                                        @if($reservation->room && $reservation->room->type_room)
                                            <!-- Card de reservación -->
                                            <div class="p-2 px-4 mb-6 w-full border rounded-lg border-green-400 hover:bg-green-500 hover:text-white flex">
                                                <div class="flex border-r hover:border-white border-green-500 items-center mr-4">
                                                    <svg class="w-24 h-24 mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M2 10v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V10H2Zm18-5h-3.5L15 3H9L7.5 5H4a2 2 0 0 0-2 2v1h20V7a2 2 0 0 0-2-2Z"/>
                                                    </svg>
                                                </div>
                                                <div class="w-full">
                                                    <p class="text-lg font-normal">Tipo de Habitación: <span class="font-semibold">{{ $reservation->room->type_room->name }}</span></p>
                                                    <p class="text-lg font-normal">Costo de la Habitación: <span class="font-semibold">{{ $reservation->room->type_room->price }}</span></p>
                                                    <p class="text-lg font-normal">Fecha de Entrada: <span class="font-semibold">{{ $reservation->check_in }}</span></p>
                                                    <p class="text-lg font-normal">Fecha de Salida: <span class="font-semibold">{{ $reservation->check_out }}</span></p>

                                                    <form action="{{ route('delete.buy', $compra->id) }}" method="POST" class="w-full flex" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reservación?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-white bg-red-500 p-2 text-right rounded-lg hover:bg-red-700 font-semibold mt-2">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-lg font-semibold text-red-500">No se encontraron detalles para esta reservación.</p>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-lg font-semibold text-red-500">No se encontraron detalles para esta compra.</p>
                                @endif
                            @endforeach
                        @endif



<!-- Verificar si no hay reservaciones -->
{{-- @if($compras->isEmpty())
<p class="text-lg font-semibold text-red-500">No hay reservaciones por pagar.</p>
@else
@foreach($compras as $compra)
    <div class="p-2 px-4 mb-6 w-full border rounded-lg border-indigo-400 hover:bg-indigo-500 hover:text-white flex">
        <!-- Card de reservación -->
        <div class="flex border-r hover:border-white border-indigo-500 items-center mr-4">
            <svg class="w-24 h-24 mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z"/>
            </svg>
        </div>
        <div class="w-full">
            <div>
                <p class="text-lg font-normal">Número de reserva: <span class="font-semibold">{{ $compra->id }}</span></p>
                @foreach($compra->reservations as $reserva)
                    <p class="text-lg font-normal">Hotel: <span class="font-semibold">{{ $reserva->room->hotel->name }}</span></p>
                    <p class="text-lg font-normal">Habitación: <span class="font-semibold">{{ $reserva->room->name }}</span></p>
                    <p class="text-lg font-normal">Tipo de habitación: <span class="font-semibold">{{ $reserva->room->type_room->name }}</span></p>
                    <p class="text-lg font-normal">Fecha de entrada: <span class="font-semibold">{{ $reserva->check_in }}</span></p>
                    <p class="text-lg font-normal">Fecha de salida: <span class="font-semibold">{{ $reserva->check_out }}</span></p>
                    <p class="text-lg font-normal">Costo de la habitación: <span class="font-semibold">{{ $reserva->room->type_room->price }}</span></p>

                    <form action="{{ route('delete.buy', $reserva->id) }}" method="POST" class="w-full flex"  onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reservación?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-500 p-2 text-right rounded-lg hover:bg-red-700 font-semibold mt-2">Eliminar</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
@endif --}}
{{--

                        @foreach($reservaciones as $compra)
                            <div class="p-2 px-4 mb-6 w-full border rounded-lg border-indigo-400 hover:bg-indigo-500 hover:text-white flex">
                                    <!-- Card de reservación -->
                                    <div class="flex border-r hover:border-white border-indigo-500 items-center mr-4">
                                        <svg class="w-24 h-24 mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z"/>
                                        </svg>
                                    </div>
                                    <div class="w-full">
                                        <div>
                                            <!-- Detalles de la reservación -->
                                            <p class="text-lg font-normal">Número de reserva: <span class="font-semibold">{{ $compra->id }}</span></p>
                                            @foreach($compra->reservations as $reserva)
                                                <p class="text-lg font-normal">Hotel: <span class="font-semibold">{{ $reserva->room->hotel->name }}</span></p>
                                                <p class="text-lg font-normal">Habitación: <span class="font-semibold">{{ $reserva->room->name }}</span></p>
                                                <p class="text-lg font-normal">Tipo de habitación: <span class="font-semibold">{{ $reserva->room->type_room->name }}</span></p>
                                                <p class="text-lg font-normal">Fecha de entrada: <span class="font-semibold">{{ $reserva->check_in }}</span></p>
                                                <p class="text-lg font-normal">Fecha de salida: <span class="font-semibold">{{ $reserva->check_out }}</span></p>
                                                <p class="text-lg font-normal">Costo de la habitación: <span class="font-semibold">{{ $reserva->room->type_room->price }}</span></p>

                                                <form action="{{ route('delete.buy', $reserva->id) }}" method="POST" class="w-full flex"  onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reservación?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-white bg-red-500 p-2 text-right rounded-lg hover:bg-red-700 font-semibold mt-2">Eliminar</button>
                                                </form>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                             @endforeach --}}


                        </div>
                    </div>
                    <div class=" mt-6 flex justify-end">
                        <a href="{{route('pay')}}" class="w-1/3 text-center text-white rounded-lg bg-indigo-500 p-2 font-semibold">Pagar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
