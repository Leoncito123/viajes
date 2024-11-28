<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-">
        <div class="max-w-8xl ">
            <div class="bg-white  dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 dark:text-gray-100">
                    <div>
                        <p class="p-2 font-semibold text-xl bg-indigo-500 text-white rounded-lg">Información de los pasajeros.</p>
                    </div>
                    <div class="mt-4">
                        <div>
                            @foreach ($createdPassengers as $passenger)
                                <div class="border mb-3 border-indigo-500 rounded-lg p-6">
                                    <div class="border-b-2 border-indigo-500 mb-2">
                                        <p class="text-xl font-semibold">Verifica tu información:</p>
                                    </div>
                                    <div class="mt-2">
                                        <p><span class="font-semibold text-lg mb-2">Nombre:</span> {{ $passenger->name }}</p>
                                        <p><span class="font-semibold text-lg mb-2">Apellido:</span> {{ $passenger->last_names }}</p>
                                        <p><span class="font-semibold text-lg mb-2">Phone:</span> {{ $passenger->phone }}</p>
                                        <p><span class="font-semibold text-lg mb-2">Asiento:</span> {{ $passenger->seat->name }}</p>
                                        <p><span class="font-semibold text-lg mb-2">Clase:</span> {{ $passenger->classe->type }}</p>
                                        <p><span class="font-semibold text-lg mb-2">Edad:</span> {{ $passenger->age->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                         </div>
                    </div>

                    <div class="mt-6">
                        <form action="{{ route('vuelo.canasta') }}" method="POST">
                            @csrf
                            @foreach ($createdPassengers as $passenger)
                                <input value="{{ $passenger->id }}" name="id_passenger_fly[]" class="">
                            @endforeach
                            <button type="submit" class="p-2 border w-full rounded-lg font-semibold bg-indigo-500 text-white text-xl">
                                Confirmar Reservación del Vuelo
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
