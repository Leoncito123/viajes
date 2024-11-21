
<button id="dropdownDefaultButton2" data-dropdown-toggle="dropdown2" class="text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Crear Clase<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdown2" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-1/2 dark:bg-gray-700">
        <form action="{{route('class.store')}}" method="POST" class="py-6 dark:text-black">
            @csrf
            <div class="mb-4 w-full px-4">
                <label for="type" class="text-md">Nombre de la clase</label>
                <div>
                    <input type="text" name="type" id="type" class="w-full rounded-lg border-indigo-500">
                </div>
            </div>
            <div class="px-4">
                <button type="submit" class="p-2 bg-indigo-500 dark:bg-blue-500 text-white rounded-lg">Crear</button>
            </div>
        </form>

    </div>


