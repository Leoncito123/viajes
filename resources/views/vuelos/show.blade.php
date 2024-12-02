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
                                    @foreach ($seats as $seat)
                                        @if($seat->status == 1)
                                            <div class=" items-center border rounded-lg border-gray-400 hover:bg-indigo-500 bg-red-500 dark:border-gray-600 hover:border-white">
                                                <a href="" class="text-black dark:text-gray-800">
                                                    <img src="{{asset('img/asiento.png')}}" class="w-20" alt="">{{$seat->name}}
                                                </a>
                                            </div>
                                        @else
                                        <div class=" items-center border rounded-lg border-gray-400 hover:bg-indigo-500 bg-white dark:border-gray-600 hover:border-white">
                                            <a href="" class="text-black dark:text-gray-800">
                                                <img src="{{asset('img/asiento.png')}}" class="w-20" alt="">{{$seat->name}}
                                            </a>
                                        </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class=" dark:border-gray-600 rounded-lg h-auto">
                                <div class="mt-4">
                                    <p class="text-2xl font-semibold font-semibol text-black dark:text-white">Registra tus datos para reservar el vuelo.</p>
                                </div>
                                <div>
                                    <form action="{{ route('reservation.store') }}" method="POST" class="p-10 mt-6 border border-indigo-500 rounded-lg">
                                        @csrf
                                        <input type="text" id="id_fly" name="id_fly" value="{{$fly->id}}" class="hidden">

                                        @for ($i = 0; $i < $cant_forms; $i++)
                                            <div class="mb-6">
                                                <h3 class="text-lg font-semibold">Pasajero {{ $i + 1 }}</h3>
                                                <label for="name">Nombre(s)</label>
                                                <input type="text" name="name[]" value="{{ old('name[]') }}" class="w-full rounded-full text-black border-indigo-500">
                                                <small>{{$errors->first('name.'.$i)}}</small>
                                            </div>
                                            <div class="mb-6">
                                                <label for="last_names">Apellidos</label>
                                                <input type="text" id="last_names" name="last_names[]" class="w-full rounded-full text-black border-indigo-500">
                                                <small>{{$errors->first('last_names.'.$i)}}</small>
                                            </div>
                                            <div class="mb-6">
                                                <label for="phone">Numero de Telefono</label>
                                                <input type="text" id="phone" name="phone[]" class="w-full rounded-full text-black border-indigo-500">
                                                <small>{{$errors->first('phone.'.$i)}}</small>
                                            </div>
                                            <div class="grid md:grid-cols-2 gap-8 mb-6">
                                                <div class="mb-">
                                                    <label for="id_gender">Genero</label>
                                                    <select name="id_gender[]" id="id_gender" class="w-full rounded-full text-black border-indigo-500">
                                                        <option value="">Selecciona una opción</option>
                                                        @foreach ($genders as $gender)
                                                            <option value="{{$gender->id}}">{{$gender->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small>{{$errors->first('id_gender.'.$i)}}</small>
                                                </div>
                                                <div class="mb-">
                                                    <label for="id_seat">Asiento</label>
                                                    <select name="id_seat[]" id="id_seat" class="w-full rounded-full text-black border-indigo-500">
                                                        <option value="">Selecciona una opción</option>
                                                        @foreach ($seatsOcupados as $seat)
                                                            <option value="{{$seat->id}}">{{$seat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small>{{$errors->first('id_seat.'.$i)}}</small>
                                                </div>
                                                <div class="mb-">
                                                    <label for="id_class">Clase</label>
                                                    <select name="id_class[]" id="id_class" class="w-full rounded-full text-black border-indigo-500">
                                                        <option value="">Selecciona una opción</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{$class->id}}">{{$class->type}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small>{{$errors->first('id_class.'.$i)}}</small>
                                                </div>
                                                <div class="mb-">
                                                    <label for="id_age">Edad del Pasajero</label>
                                                    <select name="id_age[]" id="id_age" class="w-full rounded-full text-black border-indigo-500">
                                                        <option value="">Selecciona una opción</option>
                                                        <option value="1">Infante</option>
                                                        <option value="2">Adulto</option>
                                                        <option value="3">Tercera Edad</option>
                                                    </select>
                                                    <small>{{$errors->first('id_age.'.$i)}}</small>
                                                </div>
                                            </div>
                                        @endfor

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
