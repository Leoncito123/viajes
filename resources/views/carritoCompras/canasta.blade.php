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
                        <p class="p-2 font-semibold text-xl bg-indigo-500 text-white rounded-lg">Destalles de Mi Vuelo</p>
                    </div>
                    <div>
                            <div class="mt-6">
                                <div class="w-full border border-indigo-400 rounded-lg p-6 flex">
                                    <div class="border-r-2 px-6 border-indigo-500">
                                        <img src="{{asset('img/boletoAvion.png')}}" alt="">
                                    </div>
                                    <div class="p-4 w-full">
                                        <p class="font-semibold text-lg border-b-2 border-indigo-500">Vuelo</p>
                                        <p class="font-semibold text-md mt-4">Destino:</p>
                                        <p class="font-semibold text-md">Hora de Salida:</p>
                                        <p class="font-semibold text-md">Precio:</p>
                                    </div>
                                </div>
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
