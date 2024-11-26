<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @props(['coments', 'id_hotel'])
    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md overflow-x-auto">
        @php
            $averageRating = $coments->isEmpty() ? 0 : round($coments->avg('stars'), 1);
            $fullStars = floor($averageRating);
            $hasHalfStar = $averageRating - $fullStars >= 0.5;

            $totalComments = $coments->count();

            // Agrupar comentarios por estrellas y calcular porcentajes
            $starCounts = [];
            $starPercentages = [];

            for ($i = 5; $i >= 1; $i--) {
                $count = $coments->where('stars', $i)->count();
                $starCounts[$i] = $count;
                $starPercentages[$i] = $totalComments > 0 ? round(($count / $totalComments) * 100) : 0;
            }
        @endphp

        @if ($coments->isEmpty())
            <div class="flex items-center justify-center">
                <p class="text-gray-400 dark:text-gray-600">No hay comentarios</p>
            </div>
        @endif
            {{-- Seccion de cantidad de votos --}}
            <div class="py-5 pb-5">

                <div class="flex items-center mb-2">
                    {{-- Estrellas llenas --}}
                    @for ($i = 1; $i <= $fullStars; $i++)
                        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                    @endfor

                    {{-- Media estrella si es necesario --}}
                    @if ($hasHalfStar)
                        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
                                style="clip-path: inset(0 50% 0 0)" />
                        </svg>
                    @endif

                    {{-- Estrellas vacías --}}
                    @for ($i = ceil($averageRating); $i < 5; $i++)
                        <svg class="w-4 h-4 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                    @endfor

                    <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">{{ $averageRating }}</p>
                    <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">de</p>
                    <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">5</p>
                </div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $coments->count() }} comentarios</p>
                @for ($i = 5; $i >= 1; $i--)
                    <div class="flex items-center mt-4">
                        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            {{ $i }} star
                        </a>
                        <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                            <div class="h-5 bg-yellow-300 rounded" style="width: {{ $starPercentages[$i] }}%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ $starPercentages[$i] }}%
                        </span>
                    </div>
                @endfor
            </div>

            {{-- Formulario de comentario --}}

            <form action="{{ route('comentarios.store', ['id' => $id_hotel, 'id_user' => Auth::id()]) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Titulo</label>
                        <input type="text" name="name" id="name" autocomplete="name" required
                            class="block w-full px-3 py-2 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="stars" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Estrellas</label>
                        <select name="stars" id="stars" autocomplete="stars" required
                            class="block w-full px-3 py-2 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="1">1 estrella</option>
                            <option value="2">2 estrellas</option>
                            <option value="3">3 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="5">5 estrellas</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Comentario</label>
                        <textarea id="description" name="description" rows="4" required
                            class="block w-full px-3 py-2 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus: ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                        Enviar
                    </button>
                </div>
            </form>

            @foreach ($coments as $comentario)
                <article>
                    <div class="flex items-center mb-4">
                        <img class="w-10 h-10 me-4 rounded-full"
                            src="{{ $comentario->user->profile_photo_path ? asset('storage/' . $comentario->user->profile_photo_path) : asset('img/perfil.jpg') }}"
                            alt="">
                        <div class="font-medium dark:text-white">
                            <p>{{ $comentario->user->name }} {{ $comentario->user->last_name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">
                        @for ($i = 0; $i < $comentario->stars; $i++)
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        @endfor
                        <h3 class="ms-2 text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $comentario->name }}
                        </h3>
                    </div>
                    <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                        <p>Publicado el <time datetime="2017-03-03 19:00">{{ $comentario->created_at }}</time></p>
                    </footer>
                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $comentario->description }}</p>
                </article>
            @endforeach
    </div>
</div>
