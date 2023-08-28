
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
    <title>Editar Blog</title>
</head>
<body class="bg-gray-100">

<nav class="bg-white p-4  w-full z-10 fixed">
        <div class="flex justify-between items-center">
            <!-- Logo o nombre del sitio y traductor-->
            <div id="google_translate_element"></div>
            
            <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <script src="../JS/traductor.js"></script>
            

            <!-- Menú de navegación -->
            
            <ul class="flex space-x-4">
            <li><a href="Index.php" class="text-green-600 hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" style="font-size: 1.20em; font-weight: bold;" aria-current="page">Salud Rural</a></li>
                <li><a href="Index.php" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Inicio</a></li>
                <li class="relative">
                    <!-- Enlace con menú desplegable -->
                    <a href="#" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" id="donaciones-menu">
                        <span>Donaciones</span>
                        <i class="fas fa-chevron-down ml-1"></i> <!-- Flecha hacia abajo -->
                    </a>

                    <!-- Menú desplegable -->
                    <ul class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-white shadow-md rounded-md hidden" id="donaciones-menu-items">
                        <li><a href="boton-donaciones.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Hacer donacion </a></li>
                        <li><a href="donaciones-reali.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Realizadas</a></li>
                    </ul>
                </li>
                <li><a href="blog.php" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Blog</a></li>
                <li><a href="AcercaDe.php" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Nosotros</a></li>
                <li class="relative">
                    <!-- Enlace con menú desplegable -->
                    <a href="#" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" id="hospitales-menu">
                        <span>Hospitales</span>
                        <i class="fas fa-chevron-down ml-1"></i> <!-- Flecha hacia abajo -->
                    </a>

                    <!-- Menú desplegable -->
                    <ul class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-white shadow-md rounded-md hidden" id="hospitales-menu-items">
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Necesidades actuales</a></li>
                        
                        <!-- <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Historias de exito</a></li> -->
                    </ul>
                </li>
            </ul>

            <div class="relative">
                <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                    <?php include 'mostra-imagen.php'; ?>
                    <img src="<?php echo ($usuario['foto_perfil'] != '') ? $usuario['foto_perfil'] : $imagen_predeterminada; ?>" alt="Foto de perfil"  class="rounded-full h-8 w-8">
                </button>
                <!-- Menú desplegable del usuario -->
                <ul class="absolute right-0 mt-2 py-2 w-50 bg-white rounded-lg shadow-md hidden" id="user-menu">
                <?php
                // Mostrar nombre del usuario si está disponible en la sesión
                if (isset($_SESSION['correo']) && !empty($_SESSION['correo'])) {
                    echo '<li><a href="#" class="block px-1 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">' . $_SESSION['correo'] . '</a></li>';
                }
                ?>
                <li><a href="perl-usu.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Configuración</a></li>
                <li><a href="../PHP/cerrar.php" class="block px-4 py-2 text-red-600 hover:bg-red-600 hover:text-white">Cerrar Sesión</a></li>
            </ul>
            </div>
    </nav>

<div class="container mx-auto mt-8 p-4 ">
    <h1 class="text-2xl font-bold mb-4 text-center">Editar Blog</h1>
    
    <!-- Formulario de edición -->
    <?php
    include_once 'db_connection.php'; // Incluye la conexión a la base de datos
    
    if (isset($_GET['id'])) {
        $blogId = $_GET['id'];
        $consulta = "SELECT * FROM necesidades WHERE id_necesidad = $blogId"; // Cambia esto a tu consulta SQL
        
        $resultado = $conn->query($consulta);
        
        if ($resultado->num_rows > 0) {
            $blog = $resultado->fetch_assoc();
            
            echo '<form action="cambios/actualizar_ne.php" method="post">';
            echo '<input type="hidden" name="id_necesidad" value="' . $blog['id_necesidad'] . '">';
            echo '<label for="nombre" class="block mb-2 font-semibold">Nombre:</label>';
            echo '<input type="text" name="nombre" id="nombre" class="border rounded px-2 py-1 mb-4 w-full" value="' . $blog['nombre'] . '">';
            
            echo '<label for="descripcion" class="block mb-2 font-semibold">Descripción:</label>';
            echo '<textarea name="descripcion" id="descripcion" class="border rounded px-2 py-1 mb-4 w-full">' . $blog['descripcion'] . '</textarea>';
            
            
            echo '<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>';
            echo '</form>';
        } else {
            echo '<p>No se encontró el blog.</p>';
        }
    } else {
        echo 'ID de blog no proporcionado.';
    }
    
    $conn->close();
    ?>
</div>

</body>
</html>
