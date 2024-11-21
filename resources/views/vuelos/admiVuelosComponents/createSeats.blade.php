
<button id="dropdownDefaultButton5" data-dropdown-toggle="dropdown5{{$airplane->id}}" class="text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Asignar asientos<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdown5{{$airplane->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-1/2 dark:bg-gray-700">
        <form action="{{route('seats.store')}}" method="POST" class="py-6 ">
            @csrf
            <div class="mb-4 w-full px-4">
                <label for="name" class="text-md">Numero de asientos</label>
                <div>
                    <input type="number" name="name" id="name" class="w-full rounded-lg border-indigo-500">
                </div>
            </div>
            <div class="mb-4 w-full px-4">
                    <input type="number" value="{{$airplane->id}}" name="id_airplane" id="id_airplane" class="w-full hidden rounded-lg border-indigo-500">
            </div>
            <div class="px-4">
                <button type="submit" class="p-2 bg-indigo-500 dark:bg-blue-500 text-white rounded-lg">Crear</button>
            </div>
        </form>

    </div>


