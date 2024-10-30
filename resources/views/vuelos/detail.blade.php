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
                    <div class="mt-4">
                         <div class="grid md:grid-cols-3 gap-8">
                            <div class="border border-indigo-500 rounded-lg">
                                <div>
                                    <div class="p-6">
                                        <p class="text-xl font-semibold">Tu asiento:</p>
                                    </div>
                                    <div class="w-full items-center text-center flex justify-center">
                                        <img src="{{asset('img/asiento2.png')}}" class="justify-center text-center" alt="">
                                    </div>
                                    <div class="flex text-center justify-center mt-4">
                                        <p class="font-semibold text-2xl text-indigo-500 mb-2 justify-center text-center">{{ $user->input('id_seat') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-indigo-500 rounded-lg p-6">
                                <div class="border-b-2 border-indigo-500 py-2">
                                    <p class="text-xl font-semibold">Información de tu vuelo:</p>
                                </div>
                            </div>
                            <div class="border border-indigo-500 rounded-lg p-6">
                                <div class="border-b-2 border-indigo-500 py-2">
                                    <p class="text-xl font-semibold">Verifica tu información:</p>
                                </div>
                                <div class="mt-2">
                                    <p><span class="font-semibold text-lg mb-2">Nombre:</span> {{ $user->input('name') }}</p>
                                    <p><span class="font-semibold text-lg mb-2">Apellido:</span> {{ $user->input('last_name') }}</p>
                                    <p><span class="font-semibold text-lg mb-2">Teléfono:</span> {{ $user->input('phone') }}</p>
                                    <p><span class="font-semibold text-lg mb-2">Género:</span> {{ $user->input('id_gender') }}</p>
                                    <p><span class="font-semibold text-lg mb-2">Asiento:</span> {{ $user->input('id_seat') }}</p>
                                    <p><span class="font-semibold text-lg mb-2">Clase:</span> {{ $user->input('id_class') }}</p>
                                    <p><span class="font-semibold text-lg mb-2">Edad:</span> {{ $user->input('id_ages') }}</p>
                                </div>
                            </div>
                         </div>
                    </div>

                    <div class="mt-6">
                        <form action="{{route('vuelo.canasta')}}" method="POST">
                            @csrf
                            <input type="text" value="1" id="compra" name="compra" class="hidden">
                            <button type="submit" class="p-2 border w-full rounded-lg font-semibold bg-indigo-500 text-white text-xl">Confirmar Reservación del Vuelo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
