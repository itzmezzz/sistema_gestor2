<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - LEGO</title>
    <link rel="stylesheet" href="src/output.css?=1.0">

</head>
<!-- con una clase y un color de fondo cambiamos el color de todo el cuerpo -->

<body class="bg-gray-100">
    <!-- aqui declaramos el color del fondo de nav a blanco, le aplicamos la sombra, lo expandimos para que cubra todo el ancho de la pantalla, lo posicionamos arriba y le damos un z-index (z-index para que este quede en la capa superior de la pantalla) -->
    <nav class="bg-white shadow-lg fixed  w-full top-0 z-50">
        <div class="max-w-7x1 mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Comienzo del logo y menú hamburguesa -->
                <div class="flex items center">
                    <button onclick="abrirMenu()" class="text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="CurrentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <img class="h-10" src="../img/xd.jpg" alt="">
                </div>
                <!-- Fin del logo y menú hamburguesa -->
                <!-- Inicio del nombre de usuario -->
                 <a href="../controladores/cerrar_sesion.php">
                <div class="flex items-center space-x-4">
                    <div
                        class="">
                        cerrar sesión
                    </div>
                    <h1 class="text-black font-bold"></h1>
                </div>
                </a>
                <!-- Fin del nombre de usuario -->
            </div>
        </div>
    </nav>
    <!-- overlay (fondo oscuro) -->
    <div id="overlay" onclick="cerrarMenu()" class="hidden fixed inset-0 bg-black opacity-50"></div>
    <!-- Menú lateral -->
    <aside id="sidebar"
        class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl trasform -translate-x-full transition-transform">
        <div class="p-6">
            <!-- Título y boton cerrar -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2x1 font-bold text-blue-600 mt-20">Menú</h2>
                <button onclick="cerrarMenu()" class="text-gray-700 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Opciones del menú -->
            <nav class="space-y-2">
                <a href="indexadmin.php"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">Inicio</a>
                    <a href="lista_producto.php"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">Inventario</a>
                    <a href="lista_venta.php"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">Ventas</a>
                    <a href="lista_usuario.php"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">Usuarios</a>
                    <a href="lista_categoria.php"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 text-gray-700">Categorias</a>
                </a>
               
            </nav>
        </div>
    </aside>

    <script>
        //abrir menú lateral
        function abrirMenu() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('overlay').classList.remove('hidden');
        }
        //cerrar menú lateral
        function cerrarMenu() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('overlay').classList.add('hidden');
        }
    </script>
</body>

</html>