<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-">
        <div class="max-w-8xl ">
            <div class="bg-white  dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class=" py-4 lg:py-36 w-full text-gray-900 dark:text-gray-100">
                    <div class=" w-full justify-center text-center">
                        <p class="mx-auto text-3xl lg:text-4xl sm:text-xl font-semibold">¿A donde deseas ir?</p>
                    </div>
                    <div class="mx-auto max-w-3xl mt-8 p-6  bg-indigo-500" style="border-radius: 20px;">
                        <form action="" class="text-white w-full ">
                            <div>
                                <label for="" class="font-semibold text-xl">Destino</label>
                                <input type="text" class="w-full h-12 mt-4 rounded-full border-0 text-black">
                            </div>
                            <div class="grid md:grid-cols-2 gap-4 mt-4">
                                <div class="mt-4">
                                    <label for="" class="font-semibold  text-xl">Fecha de Vuelo</label>
                                    <input type="date" class="w-full h-12 mt-4 rounded-full border-0 text-black">
                                </div>
                                <div class="mt-4">
                                    <label for="" class="font-semibold  text-xl">Fecha de Vuelo</label>
                                    <input type="date" class="w-full h-12 mt-4 rounded-full border-0 text-black">
                                </div>
                            </div>
                            <div class="w-full mt-8 mb-4 items-center flex mx-auto">
                                <a href="{{route('vuelos.index')}}" type="submit" class="mt-4 h-12 font-semibold bg-white mx-auto text-center items-center text-indigo-500 p-2 w-1/2  rounded-full">
                                    Buscar
                                </a >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
