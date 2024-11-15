@extends('vistasLeo.Admin.index')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-indigo-500 text-white dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Check-in
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Check-out
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad de adultos
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad de niños
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado de pago
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Usuario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Habitación
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($reservations->isEmpty())
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" colspan="8"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                No hay reservaciones aún
                            </th>
                        </tr>
                    @else
                        @foreach ($reservations as $reservation)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $reservation->check_in }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $reservation->check_out }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $reservation->cant_adults }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $reservation->cant_infants }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($reservation->status_payment == 0)
                                        <span class="bg-red-500 text-white font-semibold py-1 px-2 rounded-full">
                                            Pendiente
                                        </span>
                                    @else
                                        <span class="bg-green-500 text-white font-semibold py-1 px-2 rounded-full">
                                            Pagado
                                        </span>
                                    @endif
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $reservation->user->name }} {{ $reservation->user->last_names }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $reservation->room->name }}
                                </td>
                            </tr>
                            <div id="modal-images" class="hidden fixed z-10 inset-0 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen">
                                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md w-full max-w-3xl">
                                        <div class="flex justify-between items-center">
                                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Imágenes del Hotel
                                            </h2>
                                            <button onclick="closeImagesModal()"
                                                class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                                &times;
                                            </button>
                                        </div>
                                        <div id="images-container"
                                            class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
