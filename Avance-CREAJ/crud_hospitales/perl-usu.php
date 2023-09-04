<?php
session_start();
include_once 'db_connection.php'; // Incluye la conexión a la base de datos

if (isset($_SESSION['id'])) {
    $idUsuario = $_SESSION['id'];
    
    $consulta = "SELECT * FROM hospitales WHERE id = $idUsuario"; // Cambia el ID según tu caso
    $resultado = $conn->query($consulta);
    $ruta_imagen = "../imagen-hos/"; // Cambia esto a la ruta real de la imagen
    
    // Si la ruta de la imagen está vacía, utiliza una imagen predeterminada
    if (empty($ruta_imagen)) {
        $ruta_imagen = "../imagen-hos/"; // Cambia esto a la ruta de la imagen predeterminada
    }
    
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $imagen_predeterminada = "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/traductor.css">
    <title>Perfil</title>
  
</head>
<body class="bg-gray-100">
<nav class="bg-white p-4  w-full z-10 fixed ">
        <div class="flex justify-between items-center">
            <!-- Logo o nombre del sitio y traductor-->
            <div id="google_translate_element"></div>
            
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
           <!--DIV DEL TRADUCTOR-->
           <div class="md:relative md:left" id="google_translate_element"></div>
           
            <!--INICIO DEL SCRIPT DEL TRADUCTOR DE GOOGLE-->
       <script>
         // Crear un elemento <script> para cargar el script de traducción de Google
         const script = document.createElement('script');
         script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
         script.async = true;
         document.body.appendChild(script);
       
         // Función para manejar los cambios en el estilo del cuerpo
         const handleBodyChanges = () => {
           const currentTop = parseInt(document.body.style.top) || 0;
           if (currentTop > 0) {
             document.body.style.top = '0px';
           }
         };
       
         // Definir la función global googleTranslateElementInit
         window.googleTranslateElementInit = () => {
           if (!document.querySelector('.goog-te-combo')) {
             new window.google.translate.TranslateElement(
               { pageLanguage: 'es', includedLanguages: 'en,es' },
               'google_translate_element'
             );
           }
       
           // Observar los cambios en el estilo del cuerpo
           const observer = new MutationObserver(handleBodyChanges);
           observer.observe(document.body, { attributes: true, attributeFilter: ['style'] });
         };
       </script>
            

            <!-- Menú de navegación -->
            
            <ul class="hidden sm:flex space-x-4">
            <li><a href="Index.php" class="text-green-600 hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" style="font-size: 1.20em; font-weight: bold;" aria-current="page">SaludRural</a></li>
            <li><a href="#" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Inicio</a></li>
                <li class="relative">
                    <!-- Enlace con menú desplegable -->
                    <a href="#" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" id="donaciones-menu">
                        <span>Blog</span>
                        <i class="fas fa-chevron-down ml-1"></i> <!-- Flecha hacia abajo -->
                    </a>

                    <!-- Menú desplegable -->
                    <ul class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-white shadow-md rounded-md hidden" id="donaciones-menu-items">
                        <li><a href="agregar-blog.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Agregar </a></li>
                        <li><a href="realizado_blog.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Realizados</a></li>
                    </ul>
                </li>
                <li class="relative items-center">
                    <!-- Enlace con menú desplegable -->
                    <a href="#" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" id="exito-menu">
                        <span>Necesidades</span>
                        <i class="fas fa-chevron-down ml-1"></i> <!-- Flecha hacia abajo -->
                    </a>

                    <!-- Menú desplegable -->
                    <ul class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-white shadow-md rounded-md hidden" id="exito-menu-items">
                        <li><a href="agregar_necesidades.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Agregar </a></li>
                        <li><a href="realizado-necesidades.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Realizados</a></li>
                    </ul>
                </li>
            </ul>

            <div class="hidden sm:block">
                <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                    <img src="<?php echo ($usuario['foto_hospital'] != '') ? $usuario['foto_hospital'] : $imagen_predeterminada; ?>" alt="Foto de perfil" class="h-8 w-8 rounded-full" >
                </button>
                <!-- Menú desplegable del usuario -->
                <ul class="absolute right-0 mt-2 py-2 w-50 bg-white rounded-lg shadow-md hidden" id="user-menu">
                <?php
                // Mostrar nombre del usuario si está disponible en la sesión
                if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
                    echo '<li><a href="#" class="block px-1 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">' . $_SESSION['nombre'] . '</a></li>';
                }
                ?>
                <li><a href="perl-usu.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Configuración</a></li>
                <li><a href="../PHP/cerrar.php" class="block px-4 py-2 text-red-600 hover:bg-red-600 hover:text-white">Cerrar sesión</a></li>
            </ul>
            </div>
            <button id="menu-toggle" class="block sm:hidden text-gray-600 hover:text-gray-800 focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
    <ul class="mobile-menu hidden sm:hidden bg-white p-2 mt-0 rounded-md shadow-md absolute right-0 w-40">
    <li><a href="Index.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Inicio</a></li>
    <li>
        <a href="#" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white" id="donaciones-menu-cel">
            Blog <i class="fas fa-chevron-down ml-1"></i>
        </a>
        <ul class="mt-2"  id="donaciones-menu-items-cel">
            <li><a href="agregar-blog.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Agregar</a></li>
            <li><a href="realizado_blog.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Realizadas</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white" id="hospitales-menu-cel">
            Necesidades <i class="fas fa-chevron-down ml-1"></i>
        </a>
        <ul class="mt-2" id="hospitales-menu-items-cel">
        <li><a href="agregar_necesidades.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Agregar</a></li>
            <li><a href="realizado-necesidades.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Realizadas</a></li>
            <!-- Agrega más elementos de menú aquí si es necesario -->
        </ul>
    </li>
    <li><a href="perl-usu.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Configuración</a></li>
    <li><a href="../PHP/cerrar.php" class="block px-3 py-2 text-red-600 hover:bg-red-600 hover:text-white">Cerrar sesión</a></li>
    <!-- Agrega más elementos de menú aquí si es necesario -->
</ul>    <div class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Perfil de Usuario</h1>
        

        <div class="flex items-center justify-center">
            <div class="w-1/3 text-center">
                <!-- Imagen de perfil -->
                <img src="<?php echo ($usuario['foto_hospital'] != '') ? $usuario['foto_hospital'] : $imagen_predeterminada; ?>" alt="Foto de perfil" class="rounded-full h-32 w-32 object-cover mx-auto mb-2">
                
                <!-- Formulario para cambiar la imagen -->
                <form action="cambiar_imagen.php" method="post" enctype="multipart/form-data" class="mb-2">
                    <input type="file" name="nueva_imagen" class="mb-1" required>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cambiar Imagen</button>
                </form>
                
                <!-- Nombre del usuario -->
                <h2 class="text-xl font-semibold mb-2"><?php echo $usuario['nombre']; ?></h2>
            
            <!-- Formulario para cambiar el correo -->
            <form action="cambiar_nombre.php" method="post" class="mb-2">
            <label for="">Descripcion: </label>
                <input type="text" name="nuevo_correo" value="<?php echo $usuario['descripcion']; ?>" class="border rounded px-2 py-1 focus:outline-none focus:border-blue-500">
                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Cambiar</button>
            </form>
            
            <!-- Formulario para cambiar el teléfono -->
            <form action="cambiar_correo.php" method="post" class="mb-2">
                <label for="">Lugar: </label>
                <input type="text" name="nuevo_correo" value="<?php echo $usuario['lugar']; ?>" class="border rounded px-2 py-1 focus:outline-none focus:border-blue-500">
                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Cambiar</button>
            </form>
            
            <!-- DUI del usuario -->
        </div>
    </div>
    <?php
    } else {
        echo "No se encontraron datos de usuario.";
    }
    ?>
</div>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    // Script para mostrar/ocultar el menú desplegable del usuario al hacer clic en el botón del usuario
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');
    userMenuButton.addEventListener('click', () => {
        userMenu.classList.toggle('hidden');
    });

    // Script para mostrar/ocultar el menú desplegable de donaciones al hacer clic en el botón de donaciones
    const donacionesMenuButton = document.getElementById('donaciones-menu');
    const donacionesMenuItems = document.getElementById('donaciones-menu-items');
    donacionesMenuButton.addEventListener('click', () => {
        donacionesMenuItems.classList.toggle('hidden');
    });
    // Script para mostrar/ocultar el menú desplegable de donaciones al hacer clic en el botón de donaciones
    // Script para mostrar/ocultar el menú desplegable de donaciones al hacer clic en el botón de donaciones
    const exitoMenuButton = document.getElementById('exito-menu');
    const exitoMenuItems = document.getElementById('exito-menu-items');
    exitoMenuButton.addEventListener('click', () => {
        exitoMenuItems.classList.toggle('hidden');
    });
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById("menu-toggle");
        const mobileMenu = document.querySelector(".mobile-menu");

        menuToggle.addEventListener("click", function () {
            mobileMenu.classList.toggle("hidden");
        });

        const donacionesMenu = document.getElementById("donaciones-menu-cel");
        const donacionesMenuItems = document.getElementById("donaciones-menu-items-cel");

        donacionesMenu.addEventListener("click", function (event) {
            event.preventDefault();
            donacionesMenuItems.classList.toggle("hidden");
        });

        const hospitalesMenu = document.getElementById("hospitales-menu-cel");
        const hospitalesMenuItems = document.getElementById("hospitales-menu-items-cel");

        hospitalesMenu.addEventListener("click", function (event) {
            event.preventDefault();
            hospitalesMenuItems.classList.toggle("hidden");
        });
    });
      
</script>
</body>
</html>