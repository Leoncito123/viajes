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
                        <div class="grid md:grid-cols-3 gap-4">
                            @foreach($compras as $compra)
                            <div>
                                <div class="p-2 px-4 mb-6 w-full border rounded-lg border-indigo-400 hover:bg-indigo-500 hover:text-white flex">
                                    <div class="flex border-r hover:border-white border-indigo-500 items-center mr-4">
                                        <svg class="w-24 h-24 mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z"/>
                                        </svg>
                                    </div>
                                    <div class="w-full">
                                        <div>
                                            <p class="text-lg font-normal">Número de vuelo: <span class="font-semibold">{{ $compra->passenger_flies->fly->fly_number }}</span></p>
                                            <p class="text-lg font-normal">Fecha de Salida: <span class="font-semibold">{{ $compra->passenger_flies->fly->depature_date }}</span></p>
                                            <p class="text-lg font-normal">Fecha de Legada: <span class="font-semibold">{{ $compra->passenger_flies->fly->depature_date }}</span></p>
                                            <p class="text-lg font-normal">Horas de vuelo: <span class="font-semibold">{{ $compra->passenger_flies->fly->fly_duration }}</span></p>
                                            <p class="text-lg font-normal">Horas de vuelo:<span class="font-semibold"> {{ $compra->passenger_flies->fly->flyCosts->first()->cost}}</span></p>

                                        </div>
                                        <div class="w-full">
                                            <div class="mt-4 text-right">
                                                <form action="{{route('delete.buy', ['buy_id'=>$compra->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('¿Estás seguro de que deseas eliminar esta compra de tu carrito?');" class="p-2 ml-2 bg-danger bg-white text-indigo-500 border-indigo-500 rounded-lg border">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
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
