<x-app-layout>
<!--Alerta de registro de comentario-->
    @session('exito')
    <script>
        Swal.fire({
        title: "¡Gracias por tu Comentario!",
        text: '{{$value}}',
        icon: "success"
        });
    </script>
    @endsession
    <!-- Fin alerta -->
    
    <!-- INICIA FORMULARIO COMENTARIO -->
    <div class="bg-blue-400 p-6 rounded shadow-md">
        <form class="w-11/12 max-w-4xl mx-auto p-6" action="/comentarios" method="POST">
            @csrf
            <h1 class="text-4xl mb-4 tracking-wider font-light text-black dark:text-gray-200">Deja un comentario</h1>
            <p class="text-black mb-4">Cuéntanos de cómo fue tu experiencia, nos interesa saber.</p>

            <!-- Contenedor con fondo azul solo para los inputs y el botón -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="mb-4 col-span-1 md:col-span-3">
                    <textarea
                        id="comment"
                        name="comment"
                        class="w-full px-3 py-2 bg-white text-black rounded-sm border border-white focus:outline-none resize-none"
                        placeholder="Escribe tu comentario...*"
                        rows="5"
                    ></textarea>
                    <small class="text-danger fst-italic">{{$errors->first('comment')}}</small>
                </div>

                <div class="mb-4">
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="w-full px-3 py-2 bg-white text-black rounded-sm border border-white focus:outline-none"
                        placeholder="Lugar..."
                    />
                    <small class="text-danger fst-italic">{{$errors->first('name')}}</small>
                </div>
                <div class="mb-4">
                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        class="w-full px-3 py-2 bg-white text-black rounded-sm border border-white focus:outline-none"
                        placeholder="Título*"
                    />
                    <small class="text-danger fst-italic">{{$errors->first('titulo')}}</small>
                </div>
                <div class="mb-4">
                    <input
                        type="text"
                        id="hotel"
                        name="hotel"
                        class="w-full px-3 py-2 bg-white text-black rounded-sm border border-white focus:outline-none"
                        placeholder="hotel*"
                    />
                    <small class="text-danger fst-italic">{{$errors->first('hotel')}}</small>
                </div>
            </div>
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="py-4 px-6 bg-blue-900 text-white rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700"
                >
                    Realizar comentario →
                </button>
            </div>
        </form>
    </div>


    <!-- Componente para cartas de testimonios dentro del fondo azul -->
    <div class="bg-blue-400 p-8 mt-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <section class="grid place-items-center">
            <div class="container grid grid-cols-1 gap-8 my-auto lg:grid-cols-2">
                <!-- Carta 1 -->
                <div class="relative flex-col bg-clip-border rounded-xl bg-white text-gray-900 shadow-lg grid gap-2 sm:grid-cols-2">
                    <div class="relative bg-clip-border rounded-xl overflow-hidden">
                        <img src="https://bucket.material-tailwind.com/magic-ai/06b38f84f9669f766048c469ce861b81880378273a11ae9badaedfc32868ef44.jpg" alt="Revolutionizing Our Production Process" class="object-cover w-full h-full" />
                    </div>
                    <div class="p-6 px-2 sm:pr-6 sm:pl-4">
                        <p class="text-sm font-semibold mb-4">Cancún</p>
                        <a href="#" class="text-xl font-semibold text-blue-gray-900 hover:text-gray-700 mb-2">Revolutionizing Our Production Process</a>
                        <p class="text-base text-gray-500 mb-8">Learn how our recent investment in new technology has revolutionized our production process, leading to improved efficiency and product quality.</p>
                        <div class="flex items-center gap-4">
                            <img src="https://bucket.material-tailwind.com/magic-ai/6b1c5941d417a2a32baee89c2f3d1975d7d4fb81e486ed43dc1082ac54b0658b.jpg" class="rounded-full w-12 h-12" />
                            <div>
                                <p class="text-base font-semibold">John Doe</p>
                                <p class="text-sm text-gray-700">2022-08-15</p>
                                <div class="flex gap-2">
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-slate-800"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carta 2 -->
                <div class="relative flex-col bg-clip-border rounded-xl bg-white text-gray-900 shadow-lg grid gap-2 sm:grid-cols-2">
                    <div class="relative bg-clip-border rounded-xl overflow-hidden">
                        <img src="https://bucket.material-tailwind.com/magic-ai/e7aa235a7bc5f504db1c66e27ece08f8118b1da6b21c013500391afcd572cf7d.jpg" alt="Expanding Our Service Network" class="object-cover w-full h-full" />
                    </div>
                    <div class="p-6 px-2 sm:pr-6 sm:pl-4">
                        <p class="text-sm font-semibold mb-4">Madrid</p>
                        <a href="#" class="text-xl font-semibold text-blue-gray-900 hover:text-gray-700 mb-2">Expanding Our Service Network</a>
                        <p class="text-base text-gray-500 mb-8">Discover how our expansion investment has allowed us to enhance our service network, providing better support and customer experience.</p>
                        <div class="flex items-center gap-4">
                            <img src="https://bucket.material-tailwind.com/magic-ai/16d71aaeda38d7aea4412875984357949ff12e7f2c502bb20c4c1bcf6c661607.jpg" class="rounded-full w-12 h-12" />
                            <div>
                                <p class="text-base font-semibold">Jane Smith</p>
                                <p class="text-sm text-gray-700">2022-09-02</p>
                                <div class="flex gap-2">
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carta 3 -->
                <div class="relative flex-col bg-clip-border rounded-xl bg-white text-gray-900 shadow-lg grid gap-2 sm:grid-cols-2">
                    <div class="relative bg-clip-border rounded-xl overflow-hidden">
                        <img src="https://bucket.material-tailwind.com/magic-ai/dc74a867f21afc734166a6d37c08beaba4ff040664ba8ccce918e054264ad68d.jpg" alt="Sustainable Practices for a Greener Future" class="object-cover w-full h-full" />
                    </div>
                    <div class="p-6 px-2 sm:pr-6 sm:pl-4">
                        <p class="text-sm font-semibold mb-4">Oaxaca</p>
                        <a href="#" class="text-xl font-semibold text-blue-gray-900 hover:text-gray-700 mb-2">Sustainable Practices for a Greener Future</a>
                        <p class="text-base text-gray-500 mb-8">Find out how our investment in sustainable practices is driving us towards a greener future, showcasing our commitment to environmental responsibility.</p>
                        <div class="flex items-center gap-4">
                            <img src="https://bucket.material-tailwind.com/magic-ai/2fadd7f00b6d08fc9dcacef52af357ec1213c0415ab97ace57ae0f17c7f6c2c8.jpg" class="rounded-full w-12 h-12" />
                            <div>
                                <p class="text-base font-semibold">Alex Johnson</p>
                                <p class="text-sm text-gray-700">2022-09-20</p>
                                <div class="flex gap-2">
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative flex-col bg-clip-border rounded-xl bg-white text-gray-900 shadow-lg grid gap-2 sm:grid-cols-2">
                    <div class="relative bg-clip-border rounded-xl overflow-hidden">
                        <img src="https://bucket.material-tailwind.com/magic-ai/dc74a867f21afc734166a6d37c08beaba4ff040664ba8ccce918e054264ad68d.jpg" alt="Sustainable Practices for a Greener Future" class="object-cover w-full h-full" />
                    </div>
                    <div class="p-6 px-2 sm:pr-6 sm:pl-4">
                        <p class="text-sm font-semibold mb-4">CDMX</p>
                        <a href="#" class="text-xl font-semibold text-blue-gray-900 hover:text-gray-700 mb-2">Sustainable Practices for a Greener Future</a>
                        <p class="text-base text-gray-500 mb-8">Find out how our investment in sustainable practices is driving us towards a greener future, showcasing our commitment to environmental responsibility.</p>
                        <div class="flex items-center gap-4">
                            <img src="https://bucket.material-tailwind.com/magic-ai/2fadd7f00b6d08fc9dcacef52af357ec1213c0415ab97ace57ae0f17c7f6c2c8.jpg" class="rounded-full w-12 h-12" />
                            <div>
                                <p class="text-base font-semibold">Alex Johnson</p>
                                <p class="text-sm text-gray-700">2022-09-20</p>
                                <div class="flex gap-2">
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                    <i class="bi bi-star text-2xl text-yellow-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>




