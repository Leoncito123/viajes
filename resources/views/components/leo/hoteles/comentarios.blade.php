<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
        @else
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
        @endif
    </div>
</div>
