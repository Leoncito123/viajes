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
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="text-center">
                                <div class="p-4">
                                    <p class="text-2xl font-semibold">Lugares Disponibles (Reservados en <span class="text-red-700">rojo</span>).</p>
                                </div>
                                <div class="grid grid-cols-4 gap-8 w-full lg:w-1/2 mx-auto text-center border border-indigo-500 dark:border-gray-600 rounded-lg p-6">

                                    <div class=" items-center border rounded-lg border-gray-400 hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">1
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center justify-center w-full hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-center items-center justify-center w-fulltext-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">
                                            2
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">3
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">4
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">5
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">6
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">7
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">8
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">9
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">10
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">11
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">12
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">13
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">14
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">15
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">16
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">17
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">18
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">19
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">20
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">21
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">22
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">23
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">24
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">25
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">26
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-white hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">27
                                        </a>
                                    </div>
                                    <div class=" items-center border rounded-lg border-gray-400 text-center hover:bg-indigo-500 bg-red-600 dark:border-gray-600 hover:border-white">
                                        <a href="" class="text-black dark:text-gray-800">
                                            <img src="../img/asiento.png" class="w-" alt="">28
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class=" dark:border-gray-600 rounded-lg h-auto">
                                <div class="mt-4">
                                    <p class="text-2xl font-semibold font-semibol text-black dark:text-white">Registra tus datos para reservar el vuelo.</p>
                                </div>
                                <div>
                                    <form action="{{ route('reservation.store') }}" method="POST" class="p-10 mt-6 border border-indigo-500 rounded-lg">
                                        @csrf
                                        <div class="mb-6">
                                            <label for="name">Nombre(s)</label>
                                            <input type="text" id="name" name="name" class="w-full  rounded-full text-black border-indigo-500">
                                        </div>
                                        <div class="mb-6">
                                            <label for="last_name">Apellidos</label>
                                            <input type="text" id="last_name" name="last_name" class="w-full  rounded-full text-black border-indigo-500">
                                        </div>
                                        <div class="mb-6">
                                            <label for="phone">Numero de Telefono</label>
                                            <input type="text" id="phone" name="phone" class="w-full  rounded-full text-black border-indigo-500">
                                        </div>
                                        <div class="grid md:grid-cols-2 gap-8 mb-6">
                                            <div class="mb-">
                                                <label for="id_gender">Genero</label>
                                                <select name="id_gender" id="id_gender" class="w-full  rounded-full text-black border-indigo-500">
                                                    <option value="">Selecciona una opción</option>
                                                    <option value="1">Masculino</option>
                                                    <option value="2">Femenino</option>
                                                </select>
                                            </div>
                                            <div class="mb-">
                                                <label for="id_seat">Asiento</label>
                                                <select name="id_seat" id="id_seat" class="w-full  rounded-full text-black border-indigo-500">
                                                    <option value="">Selecciona una opción</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="14">14</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="20">20</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                </select>
                                            </div>
                                            <div class="mb-">
                                                <label for="id_class">Clase</label>

                                                <select name="id_class" id="id_class" class="w-full  rounded-full text-black border-indigo-500">
                                                    <option value="">Selecciona una opción</option>
                                                    <option value="1">Clase 1</option>
                                                    <option value="2">Clase 2</option>
                                                    <option value="3">Clase 3</option>
                                                </select>
                                            </div>

                                            <div class="mb-">
                                                <label for="id_ages">Edad del Pasajero</label>

                                                <select name="id_ages" id="id_ages" class="w-full  rounded-full text-black border-indigo-500">
                                                    <option value="">Selecciona una opción</option>
                                                    <option value="1">Infante</option>
                                                    <option value="2">Adulto</option>
                                                    <option value="3">Tercera Edad</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="border w-full rounded-full hover:bg-indigo-600 mt-8 border-indigo-400 bg-indigo-500 dark:bg-blue-600 dark:border-gray-200">
                                            <button type="submit" class="w-full p-2 text-white text-lg font-semibold">Reservar vuelo</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
