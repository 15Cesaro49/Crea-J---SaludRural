<?php
session_start();
include_once 'db_connection.php'; // Incluye la conexión a la base de datos

if (isset($_SESSION['id'])) {
    $idUsuario = $_SESSION['id'];
    
    $consulta = "SELECT * FROM registro WHERE id = $idUsuario"; // Cambia el ID según tu caso
    $resultado = $conn->query($consulta);
    $ruta_imagen = "../imagen-usu/"; // Cambia esto a la ruta real de la imagen
    
    // Si la ruta de la imagen está vacía, utiliza una imagen predeterminada
    if (empty($ruta_imagen)) {
        $ruta_imagen = "../imagen-usu/"; // Cambia esto a la ruta de la imagen predeterminada
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
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../CSS/traductor.css">
</head>
<body class="bg-gray-100">
<nav class="bg-white p-4  w-full z-10 fixed">
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
            <li><a class="text-green-600 rounded-md px-3 py-2 text-sm font-medium cursor-default" style="font-size: 23.5px; font-weight: bold;" aria-current="page">Salud Rural</a></li>
                <li><a href="Index.php" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"><strong>Inicio</strong></a></li>
                <li class="relative">
                    <!-- Enlace con menú desplegable -->
                    <a class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-default" id="donaciones-menu">
                        <span>Donaciones</span>
                        <i href="#" class="fas fa-chevron-down ml-1"></i> <!-- Flecha hacia abajo -->
                    </a>

                    <!-- Menú desplegable -->
                    <ul class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-white shadow-md rounded-md hidden" id="donaciones-menu-items">
                        <li><a href="boton-donaciones.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Haz tu donación</a></li>
                        <li><a href="donaciones-reali.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Realizadas</a></li>
                    </ul>
                </li>
                <li><a href="blog.php" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Blog</a></li>
                <li><a href="AcercaDe.php" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Acerca de</a></li>
                <li class="relative">
                    <!-- Enlace con menú desplegable -->
                    <a class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-default" id="hospitales-menu">
                        <span>Hospitales</span>
                        <i href="#" class="fas fa-chevron-down ml-1"></i> <!-- Flecha hacia abajo -->
                    </a>

                    <!-- Menú desplegable -->
                    <ul class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-white shadow-md rounded-md hidden" id="hospitales-menu-items">
                        <li><a href="necesidades_hospitales.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Necesidades actuales</a></li>
                        
                        <!-- <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Historias de exito</a></li> -->
                    </ul>
                </li>
            </ul>

            <div class="hidden sm:block">
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
                    echo '<li><a  class="block px-1 py-2 text-gray-800">' . $_SESSION['correo'] . '</a></li>';
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
    <ul class="mobile-menu hidden sm:hidden bg-white p-4 mt-12 rounded-md shadow-md absolute right-0 w-40">
    <li><a href="Index.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Inicio</a></li>
    <li>
        <a href="#" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white" id="donaciones-menu-cel">
            Donar <i class="fas fa-chevron-down ml-1"></i>
        </a>
        <ul class="mt-2"  id="donaciones-menu-items-cel">
            <li><a href="boton-donaciones.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Haz tu donación</a></li>
            <li><a href="donaciones-reali.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Realizadas</a></li>
        </ul>
    </li>
    <li><a href="blog.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Blog</a></li>
    <li><a href="AcercaDe.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Acerca de</a></li>
    <li>
        <a href="#" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white" id="hospitales-menu-cel">
            Hospitales <i class="fas fa-chevron-down ml-1"></i>
        </a>
        <ul class="mt-2" id="hospitales-menu-items-cel">
            <li><a href="necesidades_hospitales.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Necesidades actuales</a></li>
            <!-- Agrega más elementos de menú aquí si es necesario -->
        </ul>
    </li>
    <li><a href="perl-usu.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Configuración</a></li>
    <li><a href="../PHP/cerrar.php" class="block px-3 py-2 text-red-600 hover:bg-red-600 hover:text-white">Cerrar sesión</a></li>
    <!-- Agrega más elementos de menú aquí si es necesario -->
</ul><br><br><br><br>
    <div class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Perfil de Usuario</h1>
        

        <div class="flex items-center justify-center">
            <div class="w-1/3 text-center">
                <!-- Imagen de perfil -->
                <img src="<?php echo ($usuario['foto_perfil'] != '') ? $usuario['foto_perfil'] : $imagen_predeterminada; ?>" alt="Foto de perfil" class="rounded-full h-32 w-32 object-cover mx-auto mb-2">
                
                <!-- Formulario para cambiar la imagen -->
                <form action="../hace_cambios/cambiar_imagen.php" method="post" enctype="multipart/form-data" class="mb-2">
                    
                <label for="nueva-imagen" class="file-label">
                Seleccionar archivo
                <input type="file" name="nueva_imagen" id="nueva-imagen" class="mb-1" required>
                </label>

                <style>
                /* Estilos para el campo de entrada de tipo file */
                .file-label {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    border: 2px dashed #ccc;
                    padding: 10px;
                    border-radius: 5px;
                    cursor: pointer;
                    text-align: center;
                }

                .file-label input[type="file"] {
                    display: none; /* Oculta el campo de entrada real */
                }
                </style>
                    
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cambiar Imagen</button>
                </form>
                
                <!-- Nombre del usuario -->
                <h2 class="text-xl font-semibold mb-2"><?php echo $usuario['nombre']; ?></h2>
            
            <!-- Formulario para cambiar el correo -->
            <form action="../hace_cambios/cambiar_correo.php" method="post" class="mb-2">
                <label for="">Correo:</label>
                <input type="email" name="nuevo_correo" value="<?php echo $usuario['correo']; ?>" class="border rounded px-2 py-1 focus:outline-none focus:border-blue-500">
                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Cambiar</button>
            </form>
            
            <!-- Formulario para cambiar el teléfono -->
            <form action="../hace_cambios/cambiar_telefono.php" method="post" class="mb-2">
            <label for="">Telefono:</label>
                <input type="text" name="nuevo_telefono" value="<?php echo $usuario['telefono']; ?>" class="border rounded px-2 py-1 focus:outline-none focus:border-blue-500">
                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Cambiar</button>
            </form>
            
            <!-- DUI del usuario -->
            <p>DUI: <?php echo $usuario['dui']; ?></p>
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
    const hospitalesMenuButton = document.getElementById('hospitales-menu');
    const hospitalesMenuItems = document.getElementById('hospitales-menu-items');
    hospitalesMenuButton.addEventListener('click', () => {
        hospitalesMenuItems.classList.toggle('hidden');
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