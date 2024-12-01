@extends('vistasLeo.Admin.index')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <div class="max-w-6xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Encabezado -->
            <div class="border-b border-gray-200 bg-gray-50 p-4">
                <h2 class="text-lg font-semibold text-gray-800">Editor de Contenido</h2>
            </div>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Ups!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><span class="block sm:inline">{{ $error }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-6">
                <!-- Barra de herramientas -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-4">
                    <div class="grid grid-cols-3 gap-4 p-3">
                        <!-- Grupo de formato básico -->
                        <div class="flex items-center space-x-1">
                            <button onclick="formatText('bold')" class="editor-btn" title="Negrita">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
                                    <path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
                                </svg>
                            </button>
                            <button onclick="formatText('italic')" class="editor-btn" title="Cursiva">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 4h-9M14 20H5M15 4L9 20"></path>
                                </svg>
                            </button>
                            <button onclick="formatText('underline')" class="editor-btn" title="Subrayado">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 3v7a6 6 0 0 0 6 6 6 6 0 0 0 6-6V3"></path>
                                    <line x1="4" y1="21" x2="20" y2="21"></line>
                                </svg>
                            </button>
                            <button onclick="formatText('strikeThrough')" class="editor-btn" title="Tachado">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <path d="M16 6l-4 4-4-4"></path>
                                    <path d="M16 18l-4-4-4 4"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Grupo de alineación -->
                        <div class="flex items-center space-x-1">
                            <button onclick="formatText('justifyLeft')" class="editor-btn" title="Alinear izquierda">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <line x1="17" y1="10" x2="3" y2="10"></line>
                                    <line x1="21" y1="6" x2="3" y2="6"></line>
                                    <line x1="21" y1="14" x2="3" y2="14"></line>
                                    <line x1="17" y1="18" x2="3" y2="18"></line>
                                </svg>
                            </button>
                            <button onclick="formatText('justifyCenter')" class="editor-btn" title="Centrar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <line x1="18" y1="10" x2="6" y2="10"></line>
                                    <line x1="21" y1="6" x2="3" y2="6"></line>
                                    <line x1="21" y1="14" x2="3" y2="14"></line>
                                    <line x1="18" y1="18" x2="6" y2="18"></line>
                                </svg>
                            </button>
                            <button onclick="formatText('justifyRight')" class="editor-btn" title="Alinear derecha">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <line x1="21" y1="10" x2="7" y2="10"></line>
                                    <line x1="21" y1="6" x2="3" y2="6"></line>
                                    <line x1="21" y1="14" x2="3" y2="14"></line>
                                    <line x1="21" y1="18" x2="7" y2="18"></line>
                                </svg>
                            </button>
                        </div>

                        <!-- Grupo de inserción -->
                        <div class="flex items-center space-x-1">
                            <button onclick="insertLink()" class="editor-btn" title="Insertar enlace">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
                            </button>
                            <button onclick="insertImage()" class="editor-btn" title="Insertar imagen">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                            </button>
                            <button onclick="insertTable()" class="editor-btn" title="Insertar tabla">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                    <line x1="3" y1="9" x2="21" y2="9"></line>
                                    <line x1="3" y1="15" x2="21" y2="15"></line>
                                    <line x1="9" y1="3" x2="9" y2="21"></line>
                                    <line x1="15" y1="3" x2="15" y2="21"></line>
                                </svg>
                            </button>
                            <button onclick="formatText('removeFormat')" class="editor-btn" title="Limpiar formato">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contenedor del Editor y Vista Previa -->
                <form id="content-form" action="{{ route('admin.hoteles.politicas.store', $id) }}" method="POST"
                    onsubmit="saveContent()">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Editor -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gray-50 rounded-lg"></div>
                            <div id="editor" contenteditable="true"
                                class="relative bg-white border border-gray-200 rounded-lg shadow-sm p-4 min-h-[400px] max-h-[600px] overflow-y-auto focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                {!! $politicas !!}
                            </div>
                        </div>

                        <!-- Vista Previa -->
                        <div class="relative hidden lg:block">
                            <div class="absolute inset-0 bg-gray-50 rounded-lg"></div>
                            <div id="preview"
                                class="relative bg-white border border-gray-200 rounded-lg shadow-sm p-4 min-h-[400px] max-h-[600px] overflow-y-auto">
                            </div>
                        </div>
                    </div>

                    <!-- Botones de control -->
                    <div class="flex justify-end space-x-4 mt-6">
                        <button type="button" onclick="togglePreview()"
                            class="preview-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            <span class="preview-text">Ver Vista Previa</span>
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Guardar Cambios
                        </button>
                        <a href="{{ route('admin.hoteles') }}" class="btn bg-gray-500 text-white px-4 py-2 rounded-lg ">
                            Cancelar
                        </a>
                    </div>
                    <input type="hidden" name="cancellation_policies" id="content">
                </form>
            </div>
        </div>
    </div>

    <style>
        .editor-btn {
            @apply p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200;
        }

        .editor-btn svg {
            @apply text-gray-600;
        }

        .editor-btn:hover svg {
            @apply text-gray-800;
        }

        #editor img {
            max-width: 100%;
            height: auto;
        }
    </style>

    <script>
        let previewVisible = false;

        function formatText(command, value = null) {
            document.execCommand(command, false, value);
            updatePreview();
        }

        function updatePreview() {
            const preview = document.getElementById('preview');
            const editor = document.getElementById('editor');
            preview.innerHTML = editor.innerHTML;
        }

        function insertLink() {
            const url = prompt('Ingresa la URL del enlace:', 'https://');
            if (url) {
                document.execCommand('createLink', false, url);
                updatePreview();
            }
        }

        function insertImage() {
            const url = prompt('Ingresa la URL de la imagen:', 'https://');
            if (url) {
                document.execCommand('insertImage', false, url);
                updatePreview();
            }
        }

        function insertTable() {
            const html = `
        <table class="min-w-full border border-gray-200 my-4">
            <thead>
                <tr>
                    <th class="border border-gray-200 p-2">Encabezado 1</th>
                    <th class="border border-gray-200 p-2">Encabezado 2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-200 p-2">Celda 1</td>
                    <td class="border border-gray-200 p-2">Celda 2</td>
                </tr>
            </tbody>
        </table>
    `;
            document.execCommand('insertHTML', false, html);
            updatePreview();
        }

        function togglePreview() {
            const editor = document.getElementById('editor').parentElement;
            const preview = document.getElementById('preview').parentElement;
            const previewText = document.querySelector('.preview-text');
            const container = document.querySelector('.grid');

            previewVisible = !previewVisible;

            if (previewVisible) {
                container.classList.remove('lg:grid-cols-2');
                editor.classList.add('hidden');
                preview.classList.remove('hidden');
                preview.classList.add('block');
                previewText.textContent = 'Volver al Editor';
            } else {
                container.classList.add('lg:grid-cols-2');
                editor.classList.remove('hidden');
                preview.classList.add('hidden');
                preview.classList.remove('block');
                previewText.textContent = 'Ver Vista Previa';
            }
            updatePreview();
        }

        function saveContent() {
            const editorContent = document.getElementById('editor').innerHTML;
            document.getElementById('content').value = editorContent;
        }

        // Inicializar
        document.getElementById('editor').addEventListener('input', updatePreview);
        document.execCommand('defaultParagraphSeparator', false, 'p');
        updatePreview();
    </script>
@endsection
