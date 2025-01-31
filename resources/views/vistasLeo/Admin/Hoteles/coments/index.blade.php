@extends('vistasLeo.Admin.index')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md overflow-x-auto">
            @if ($coments->isEmpty())
                <div class="flex items-center justify-center">
                    <p class="text-gray-400 dark:text-gray-600">No hay comentarios</p>
                </div>
            @else
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Comentarios</h1>
                <hr class="my-4">
                {{-- Promedio --}}
                <div class="flex items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Promedio de estrellas</h2>
                    <div class="flex items-center space-x-1 rtl:space-x-reverse">
                        @for ($i = 0; $i < $promedio; $i++)
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                xmlns="http://www.w3.org/
                            2000/svg" fill="currentColor"
                                viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        @endfor
                        <p class="text-gray-500 dark:text-gray-400">{{ $promedio }}</p>
                    </div>
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

@endsection
