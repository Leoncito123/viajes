<div class="flex mt-2">
    <!-- Modal toggle -->
    <button data-modal-target="default-modal2" data-modal-toggle="default-modal2" class=" block text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Asignar Costo
    </button>

    <!-- Main modal -->
    <div id="default-modal2" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-4 border-b-2 border-indigo-500">
                <p class="font-semibold text-xl"> Asignar Precio</p>
                </div>
                <form action="{{route('costo.vuelo')}}" method="POST" class="py-6 ">
                    @csrf
                    <div class="mb-4 w-full px-4">
                        <input type="text" name="id_fly" value="{{$fly->id}}" hidden>
                        <label for="cost" class="text-md">Precio</label>
                        {{-- <div>
                            <input type="text" name="cost" id="cost" class="w-full rounded-lg border-indigo-500" value="{{$fly->flycosts->first()->cost ? $fly->flycosts->first()->cost : '0' }}">
                        </div> --}}
                    </div>

                    <div class="mb-4 w-full px-4">
                        <label for="id_class" class="text-md">Clase</label>
                        <div>
                            <select name="id_class" id="id_class" class="w-full rounded-lg border-indigo-500" id="">
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->type }}</option>
                        @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="px-4">
                        <button type="submit" class="p-2 bg-indigo-500 dark:bg-blue-500 text-white rounded-lg">Asignar Costo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
