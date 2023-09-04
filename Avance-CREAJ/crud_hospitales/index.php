<?php
session_start();
error_reporting(0);

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
    echo '<script language="javascript">alert("Por favor inicie sesión o regístrese");window.location.href="../HTML/login.php"</script>';
    die();
} else {
    include("../PHP/conex.php");

    // Consulta SQL para obtener el ID del usuario según el correo electrónico
    $nombre = $_SESSION['nombre'];
    $query = "SELECT id FROM hospitales WHERE nombre = '$nombre'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['hospital_id'] = $row['id'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>SaludRural</title>
    <link rel="shortcut icon" href="../Imagenes/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/traductor.css">
    
  </head>
  <body>
  <nav class="bg-white p-4  w-full z-10 ">
        <div class="flex justify-between items-center">
           
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
            <li><a href="index.php" class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Inicio</a></li>
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
                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
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
    li
    <li><a href="perl-usu.php" class="block px-3 py-2 text-gray-800 hover:bg-blue-600 hover:text-white">Configuración</a></li>
    <li><a href="../PHP/cerrar.php" class="block px-3 py-2 text-red-600 hover:bg-red-600 hover:text-white">Cerrar sesión</a></li>
    <!-- Agrega más elementos de menú aquí si es necesario -->
</ul>
    <main>
    <section class="bg-blue-600 text-white py-24">
      <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4">¡Ayúdanos a llevar la salud a zonas rurales!</h1>
        <p class="text-lg mb-8">Tu generosa donación marca la diferencia en la vida de quienes más lo necesitan.</p>
        <a href="../HTML/boton-donaciones.php" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out">Realizar Donación</a>
      </div>
    </section>
    <section class="bg-white py-24">
      <div class="container mx-auto text-center">
        <h2 class="text-2xl font-bold mb-4">¿Como tu donación ayudara a las pesonas?</h2>
        <p class="text-lg mb-8">Muchos centros hospitalarios, especialmente en áreas de bajos recursos o en momentos de crisis, pueden enfrentar limitaciones financieras y carecer de los recursos necesarios para proporcionar atención médica de calidad. Las donaciones pueden ayudar a compensar estas limitaciones y garantizar que los hospitales tengan acceso a los equipos, suministros y personal necesarios para brindar atención médica adecuada.
          
        <!--Respuesta a Emergencias: En situaciones de emergencia, como desastres naturales o epidemias, los hospitales pueden verse abrumados por la demanda de atención médica. Las donaciones permiten a los hospitales estar mejor preparados para responder a estas situaciones críticas al proporcionar los recursos necesarios para manejar un aumento repentino en la demanda de atención médica.

        Atención a Grupos Vulnerables: Los hospitales que atienden a poblaciones desfavorecidas o marginadas a menudo enfrentan desafíos adicionales para proporcionar atención médica adecuada. Las donaciones pueden ayudar a abordar estas disparidades al proporcionar recursos adicionales para garantizar que todos tengan acceso a atención médica de calidad.

        Mejora de la Infraestructura: Los hospitales a menudo necesitan actualizar su infraestructura, como la renovación de instalaciones obsoletas, la compra de equipos médicos modernos y la mejora de la capacidad de atención. Las donaciones pueden permitir que los hospitales realicen estas mejoras, lo que a su vez beneficia a los pacientes al ofrecer un entorno más seguro y cómodo para recibir atención médica. -->
        </p>
        <a href="../HTML/AcercaDe.php" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out">Leer más sobre nuestra misión</a>
      </div>
    </section>

    <div class="flex min-h-screen items-center justify-center p-10 bg-white">
  <div class="container grid max-w-screen-xl gap-8 lg:grid-cols-2 lg:grid-rows-2">
    <div class="row-span-2 flex flex-col rounded-md border border-slate-200">
      <div class="h-1/2 flex-1"><img src="../Imagenes/3.jpeg" class="w-full object-cover object-right-top" alt="omnichannel" /></div>
      <div class="p-10">
        <h3 class="text-xl font-medium text-gray-700">Respuesta a Emergencias:</h3>
        <p class="mt-2 text-slate-500">En situaciones de emergencia, como desastres naturales o epidemias, los hospitales pueden verse abrumados por la demanda de atención médica. Las donaciones permiten a los hospitales estar mejor preparados para responder a estas situaciones críticas al proporcionar los recursos necesarios para manejar un aumento repentino en la demanda de atención médica.</p>
      </div>
    </div>
    <div class="flex rounded-md border border-slate-200">
      <div class="flex-1 p-10">
        <h3 class="text-xl font-medium text-gray-700">Atención a Grupos Vulnerables:</h3>
        <p class="mt-2 text-slate-500">Los hospitales que atienden a poblaciones desfavorecidas o marginadas a menudo enfrentan desafíos adicionales para proporcionar atención médica adecuada. Las donaciones pueden ayudar a abordar estas disparidades al proporcionar recursos adicionales para garantizar que todos tengan acceso a atención médica de calidad.</p>
      </div>

      <div class="relative hidden h-full w-1/3 overflow-hidden lg:block">
        <div class="absolute inset-0">
          <img src="../Imagenes/2.png" class="h-full w-full object-cover object-left-top" alt="" />
        </div>
      </div>
    </div>
    <div class="flex rounded-md border border-slate-200">
      <div class="flex-1 p-10">
        <h3 class="text-xl font-medium text-gray-700">Mejora de la Infraestructura:</h3>
        <p class="mt-2 text-slate-500">Los hospitales a menudo necesitan actualizar su infraestructura, como la renovación de instalaciones obsoletas, la compra de equipos médicos modernos y la mejora de la capacidad de atención. Las donaciones pueden permitir que los hospitales realicen estas mejoras, lo que a su vez beneficia a los pacientes al ofrecer un entorno más seguro y cómodo para recibir atención médica.</p>
      </div>

      <div class="relative hidden h-full w-1/3 overflow-hidden lg:block">
        <div class="absolute inset-0">
          <img src="../Imagenes/4.jpg" class="h-full w-full object-cover object-left-top" alt="" />
        </div>
      </div>
    </div>
  </div>
</div>
</main>
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