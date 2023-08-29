<?php
session_start();
error_reporting(0);

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo']) || empty($_SESSION['correo'])) {
    echo '<script language="javascript">alert("Por favor inicie sesión o regístrese");window.location.href="../HTML/login.php"</script>';
    die();
} else {
    include("../PHP/conex.php");

    // Consulta SQL para obtener el ID del usuario según el correo electrónico
    $correo = $_SESSION['correo'];
    $query = "SELECT id FROM registro WHERE correo = '$correo'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $row['id'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Necesidades actuales</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    /* INICIO DE EL ESTILO DE EL TRADUCTOR */

/* Quita el texto (Con la tecnologia de) */
div .skiptranslate.goog-te-gadget, .goog-te-combo .dark{
    font-size: 0%;
  }
  
  /* Quita el texto (Traductor de google) */
  div .skiptranslate.goog-te-gadget span a{
    font-size: 0;
  }
  
  /* Cambia el estilo del boton para seleccionar el idioma */
  div .goog-te-combo{
            color: #000000;
            font-weight: bold;
            cursor: pointer;
            border: none;
            border-radius: 10px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            padding: 10px 20px;
            transition: background-color 0.1s, color 0.1s;
  }
  div .goog-te-combo:hover{
    background-color: blue;
    color: #ffffff;
  }
  /* Cambia el tamaño y mueve la parte azul del traductor*/
  .VIpgJd-ZVi9od-ORHb-OEVmcd.skiptranslate , .VIpgJd-ZVi9od-ORHb{
    width: 55%;
    top: 1.3%;
    left: -52.9%;
  }
  
  /* Cambia el estilo de la lista de idiomas del menú del traductor */
  .goog-te-combo option{
    background-color: #ffffff;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-weight: bold;
    color: #000000;
    -webkit-o-border-radius: 10px;
    -moz-o-border-radius: 10px;
    -ms-o-border-radius: 10px;
  }
  
  /* Hace invisible la imagen de "Google" */
  a img{
    width: 0;
  }
  
  </style>
</head>
<body class="bg-gray-100">
<nav class="bg-white p-4  w-full z-10 fixed">
        <div class="flex justify-between items-center">
            <!-- Logo o nombre del sitio y traductor-->
            <div id="google_translate_element"></div>
            
            <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <script src="../JS/traductor.js"></script>
            

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
</ul><br><br><br>

<main class="container mx-auto mt-8 flex-grow mb-8">
    <section class="flex justify-center">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php
    include_once 'db_connection.php'; // Asegúrate de incluir el archivo de conexión a la base de datos

    $consulta = "SELECT id_necesidad ,id_hospital, nombre, descripcion, lugar, imagen FROM necesidades";
    $result = $conn->query($consulta);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<article class="bg-white p-6 rounded-md shadow-lg hover:shadow-xl transition duration-300 flex flex-col justify-between">';
                echo '<div>';
                echo '<h2 class="text-xl font-semibold mb-2 text-indigo-600 text-center">Nombre:  ' . $row['nombre'] . '</h2>';
                echo '<p class="text-gray-700 mb-4">Necesidad: ' . $row['descripcion'] . '</p>';
                echo '<p class="text-gray-700 mb-4">Nombre del hospital que lo necesita: ' . $row['lugar'] . '</p>';
                echo '<img src="' . $row['imagen'] . '" alt="Imagen del artículo" class="mb-4 rounded-md">';

                // Obtener el nombre del hospital
                $hospital_id = $row['id_hospital'];
                $consulta_hospital = "SELECT nombre FROM hospitales WHERE id = $hospital_id";
                $result_hospital = $conn->query($consulta_hospital);

                if ($result_hospital) {
                    if ($result_hospital->num_rows > 0) {
                        $nombre_hospital = $result_hospital->fetch_assoc()['nombre'];
                        echo '';
                        echo '<a href="boton-donaciones.php" class="text-white bg-indigo-600 hover:bg-indigo-700 rounded-md py-2 text-center" >Lugar a donar: ' . $nombre_hospital . '</a>';
                        echo '</div>';
                        echo '</article>';
                    } else {
                        echo '<div class="flex justify-end mt-4">';
                        echo '<span class="text-white bg-indigo-600 hover:bg-indigo-700 rounded-md py-2 text-center">Nombre de hospital no encontrado</span>';
                        echo '</div>';
                    }
                } else {
                    echo 'Error en la consulta del nombre del hospital: ' . $conn->error;
                }
            }
        } else {
            echo '<p>No se encontraron necesidades de hospitales.</p>';
        }
    } else {
        echo 'Error en la consulta: ' . $conn->error;
    }

    $conn->close();
    ?>

</div>
</section>
</main>


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
<footer class="bg-gray-800 text-center text-white py-8">
  <div class="container mx-auto">
    <p class="text-lg font-bold">Salud Rural</p>
    <p class="text-sm mt-2 mb-4">Si deseas saber más información sobre nosotros, puedes buscarnos y contactarnos en nuestras redes sociales.</p>
    <div class="flex justify-center space-x-4 mb-4">
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
    </div>
    <ul class="flex items-center justify-center space-x-4">
      <li><a href="Index.php" class="text-gray-400 hover:text-white">Inicio</a></li>
      <li><a href="../HTML/boton-donaciones.php" class="text-gray-400 hover:text-white">Donaciones</a></li>
      <li><a href="../HTML/blog.php
" class="text-gray-400 hover:text-white">Blog</a></li>
      <li><a href="../HTML/AcercaDe.php" class="text-gray-400 hover:text-white">Acerca de</a></li>
    </ul>
    <div class="footer-bottom">
        <p><small id="26">&copy; 2023 <b>Salud Rural</b> - Todos los Derechos Reservados.</small></p>
      </div>
  </div>
</footer>
</body>
</html>