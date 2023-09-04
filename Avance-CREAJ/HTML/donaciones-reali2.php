<?php
session_start();
error_reporting(0);
$correo = $_SESSION['correo'];

if ($correo == null || $correo == '') {
  echo '<script language="javascript">alert("Por favor inicie sesión o regístrese");window.location.href="../HTML/login.php"</script>';
  die();
} else {
  include("../PHP/conex.php");

  // Consulta SQL para obtener el ID del usuario según el correo electrónico
  $query = "SELECT id FROM registro WHERE correo = '$correo'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['usuario_id'] = $row['id'];
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Donaciones realizadas</title>
    <link rel="shortcut icon" href="../Imagenes/favicon.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../CSS/traductor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    

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
            <li><a class="text-green-600 rounded-md px-3 py-2 text-sm font-medium cursor-default" style="font-size: 23.5px; font-weight: bold;" aria-current="page">SaludRural</a></li>
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
</ul></br></br></br></br>
    <div class="cuadro">
        <p class="mensaje">Si necesitas corregir alguna información de tus donaciones, envíanos un mensaje a este correo</p>
        <a class="correo" href="mailto:admin@gmail.com">admin@gmail.com</a>
    </div>
    <!-- Estilo CSS del apartado de aclaración sobre enviar un correo... -->
    <style>
        body {
            justify-content: center;
            min-height: 100vh;
        }

        .cuadro {
            border: 2px solid #ccc;
            background-color: #fff;
            text-align: center;
            max-width: 80%;
            padding: 15px;
            margin: 0 auto;
            width: 300px;
            border-radius: 6px;
        }

        .mensaje {
            font-size: 16.7px;
            color: #333;
            margin-bottom: 3.8px;
        }

        .correo {
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }

        .correo:hover {
            text-decoration: underline;
            font-weight: bold; 
        }
    </style>

    <div class="w-full max-w-mn p-8  rounded-lg   mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4 text-center">Donaciones realizadas</h1>
        <ul class="flex space-x-4 ">
                <li class="relative">
                    <!-- Enlace con menú desplegable -->
                    <a href="#" class="bg-white text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" id="donaciones-menu-cate">
                        <span>Donaciones de medicamentos</span>
                        <i class="fas fa-chevron-down ml-1"></i> <!-- Flecha hacia abajo -->
                    </a>

                    <!-- Menú desplegable -->
                    <ul class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-white shadow-md rounded-md hidden" id="donaciones-cate-items">
                        <li><a href="donaciones-reali2.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Donaciones de medicamentos</a></li>
                        <li><a href="donaciones-reali3.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Donaciones de equipos médicos</a></li>
                        <li><a href="donaciones-reali4.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Donaciones de insumos médicos</a></li>
                        <li><a href="donaciones-reali.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Donaciones monetarias</a></li>
                    </ul>
                </li>
        </ul>
        <?php

            // Verificar si el usuario ha iniciado sesión
            if (!isset($_SESSION['usuario_id'])) {
                // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de error
                header('Location: login.php');
                exit();
            }
            
            // Realizar la conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "saludrural";
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }
            
            // Obtener el usuario_id de la sesión
            $usuarioId = $_SESSION['usuario_id'];
            
            // Realizar la consulta para obtener las donaciones del usuario
            $sql = "SELECT id_donacion, id_hospital, fecha, medicamento, descripcion, estado FROM medicamentos WHERE id_usuario = $usuarioId";
            $resultado = $conn->query($sql);
            
            // Verificar si hubo algún error en la consulta
            if ($resultado === false) {
                // Manejo de errores
                echo "Error en la consulta: " . $conn->error;
            } else {
                if ($resultado->num_rows > 0) {
                    echo '<div class="grid grid-cols-2 gap-8">';
                    while ($donacion = $resultado->fetch_assoc()) {
                        echo '<div class="bg-white p-4 rounded-lg shadow-md">';
                        echo '<div><span class="font-semibold">ID:</span> ' . $donacion['id_donacion'] . '</div>';
                        echo '<div><span class="font-semibold">Hospital:</span> ' . obtenerNombreHospital($conn, $donacion['id_hospital']) . '</div>';
                        echo '<div><span class="font-semibold">Fecha de Donación:</span> ' . $donacion['fecha'] . '</div>';
                        echo '<div><span class="font-semibold">Nombre del medicamento:</span> ' . $donacion['medicamento'] . '</div>';
                        echo '<div><span class="font-semibold">Descripción:</span> ' . $donacion['descripcion'] . '</div>';
                        echo '<div><span class="font-semibold">Estado de la donación:</span> ' . $donacion['estado'] . '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="text-center mt-4">No se encontraron donaciones para este usuario.</div>';
                }
            }
            
            // Cerrar la conexión
            $conn->close();
            
            // Función para obtener el nombre del hospital por su ID
            function obtenerNombreHospital($conn, $id_hospital) {
                // Realizar la consulta para obtener el nombre del hospital por su ID
                $sql = "SELECT nombre FROM hospitales WHERE id = $id_hospital";
                $resultado = $conn->query($sql);
            
                // Verificar si hubo algún error en la consulta
                if ($resultado === false) {
                    // Manejo de errores
                    return "Hospital Desconocido";
                } else {
                    if ($resultado->num_rows > 0) {
                        $nombre_hospital = $resultado->fetch_assoc()['nombre'];
                        return $nombre_hospital;
                    } else {
                        return "Hospital Desconocido";
                    }
                }
            }
            ?>

    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        // Script para mostrar/ocultar el menú desplegable al hacer clic en "Donaciones"
        const donacionesMenu = document.getElementById('donaciones-menu');
        const donacionesMenuItems = document.getElementById('donaciones-menu-items');
        donacionesMenu.addEventListener('click', () => {
            donacionesMenuItems.classList.toggle('hidden');
        });

        // Script para mostrar/ocultar el menú desplegable al hacer clic en "Donaciones"
        const donacionesMenuCate = document.getElementById('donaciones-menu-cate');
        const donacionesMenuItemsCate = document.getElementById('donaciones-cate-items');
        donacionesMenuCate.addEventListener('click', () => {
            donacionesMenuItemsCate.classList.toggle('hidden');
        });

        // Script para mostrar/ocultar el menú desplegable del usuario al hacer clic en el botón del usuario
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
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
<!-- Código del footer 
<footer class="bg-gray-800 text-center text-white py-8">
  <div class="container mx-auto">
    <p class="text-lg font-bold">SaludRural</p>
    <p class="text-sm mt-2 mb-4">Si deseas saber más información sobre nosotros, puedes buscarnos y contactarnos en nuestras redes sociales.</p>
    <div class="flex justify-center space-x-4 mb-4">
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
    </div>
    <ul class="flex items-center justify-center space-x-4">
      <li><a href="../HTML/Index.php" class="text-gray-400 hover:text-white">Inicio</a></li>
      <li><a href="../HTML/boton-donaciones.php" class="text-gray-400 hover:text-white">Donaciones</a></li>
      <li><a href="../HTML/blog.php" class="text-gray-400 hover:text-white">Blog</a></li>
      <li><a href="../HTML/AcercaDe.php" class="text-gray-400 hover:text-white">Acerca de</a></li>
    </ul>
    <div class="footer-bottom">
     <p><small id="26">&copy; 2023 <b>SaludRural</b> - Todos los Derechos Reservados.</small></p>
    </div>
  </div>
</footer>-->
</html>
 


