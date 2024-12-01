<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="py-">
        <div class="max-w-10xl h-full">
            @if (session('pagado'))
                <script>
                    Swal.fire({
                        title: "¡Pago Completado!",
                        text: "¡Tu pago ha sido completado con éxito!",
                        icon: "success"
                    });
                </script>
            @endif

            <div class="bg-white h-full dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 dark:text-gray-100">
                    <div class="grid md:grid-cols-2">
                        <div>
                            <div class="px-0 lg:px-10 py-4 lg:py-4">
                                <div class="flex">
                                    <div class="mr-4">
                                        <svg class="w-6 h-6 ml-4 text-indigo-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                          </svg>
                                    </div>
                                    <div class="border-l-2 border-indigo-500 dark:border-white">
                                        <p class="ml-4 font-semibold text-indigo-500 dark:text-white text-lg">Turistas Sin Maps</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <p class="ml-4 font-semibold  text-4xl">MXN ${{$costoTotal}}<span class="text-sm">.00</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="h-full">
                            <div class="container mx-auto ">
                                <form action="{{route('payment')}}" method="POST" class="max-w-xl lg:px-16 lg:py-12 px-8 py-8 mx-auto p-8 rounded-lg shadow-lg dark:text-white border border-indigo-500">
                                    @csrf
                                    <h3 class="text-xl font-semibold text-indigo-500 mb-4">
                                        Metodo de Pago
                                    </h3>
                                    <div>

                                        <div class="mb-4">
                                            <label for="buyer" class="block text-sm font-medium text-gray-700 dark:text-white">
                                                Nombre en Tarjeta
                                            </label>
                                            <input type="text" id="buyer" name="buyer" placeholder="Ingresa Nombre de la Tarjeta"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                        <small>{{$errors->first('cardName')}}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="cardNumber" class="block text-sm font-medium text-gray-700 dark:text-white">
                                                Número de Tarjeta
                                            </label>
                                            <input type="text" id="cardNumber" name="cardNumber" placeholder="Ingresa Número de Tarjeta"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                        <small>{{$errors->first('cardNumber')}}</small>
                                        </div>
                                        <div class="">
                                            <label for="expMonth" class="block text-sm font-medium text-gray-700 dark:text-white">Fecha de Expiración</label>
                                        </div>
                                        <div class="grid md:grid-cols-2 gap-6">
                                                <div class=" mr-2">
                                                    <input type="text" id="expMonth" name="expMonth" placeholder="MM"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                                    <small>{{$errors->first('expMonth')}}</small>
                                                </div>
                                                <div class=" ml-2">
                                                    <input type="text" id="expYear" name="expYear"  placeholder="YYYY"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                                <small>{{$errors->first('expYear')}}</small>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 mt-4">
                                        <label for="cvv" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            CVV:
                                        </label>
                                        <input type="text" id="cvv" name="cvv" placeholder="CVV"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                        <small>{{$errors->first('cvv')}}</small>
                                    </div>
                                    <button type="submit" class="bg-indigo-500 text-white p-2 rounded-lg mt-2 w-full "> Proceder al pago</button>
                                    <div class="py2 lg:py-20">

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <script>
                        document.getElementById('checkoutBtn')
                                  .addEventListener('click', function (event) {
                            event.preventDefault();
                            alert('Proceeding to checkout.');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
