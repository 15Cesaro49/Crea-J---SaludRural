<!DOCTYPE html>
<html lang="es">
  <head>
    <link rel="shortcut icon" href="../../Imagenes/favicon.png"/>
  </head>
    <body>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>

<?php
session_start();
error_reporting(0);

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo']) || empty($_SESSION['correo'])) {
  echo "
      <script language='JavaScript'>
          swal.fire({
              icon: 'success',
              title: '¡Bienvenid@ a SaludRural!',
              showConfirmButton: false,
              timer: 2000
          }).then(function() {
              window.location = 'Index.html';
          });
      </script>";
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
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../CSS/traductor.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../../Imagenes/favicon.png"/>
    <title>SaludRural</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  </head>
  
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer"/> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="../CSS/traductor.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="shortcut icon" href="../Imagenes/favicon.png"/>
        <title>Acerca De</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/> -->

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
</ul>

    <main>
    <!-- Código del slider (portada) -->
    <section class="bg-blue-600 text-white py-24">
      <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4" style="font-size: 950;">¡Bienvenid@ a SaludRural!</h1>
        <p class="text-lg mb-8" style="font-size: larger;">"Sembrando Bienestar en Cada Rincón. Únete a Nuestro Camino de Salud y Comunidad".</p>
        <a href="../HTML/boton-donaciones.php" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out">Realizar donación</a>
      </div>
    </section>

    <!-- Código del cuerpo (información) de la página -->
    <section class="bg-white py-24 pt-12 pb-3">
      <div class="container mx-auto text-center">
        <h2 class="text-2xl font-bold mb-3">¿Cómo tu donación ayuda a las personas más necesitadas?</h2>
        <p class="text-lg mb-8">Muchos centros hospitalarios, especialmente en áreas de bajos recursos o en momentos de crisis, pueden enfrentar limitaciones financieras y carecer de los recursos necesarios para proporcionar atención médica de calidad. Las donaciones pueden ayudar a compensar estas limitaciones y garantizar que los hospitales tengan acceso a los equipos, suministros y personal necesario para brindar atención médica adecuada.
          
        <!--Respuesta a Emergencias: En situaciones de emergencia, como desastres naturales o epidemias, los hospitales pueden verse abrumados por la demanda de atención médica. Las donaciones permiten a los hospitales estar mejor preparados para responder a estas situaciones críticas al proporcionar los recursos necesarios para manejar un aumento repentino en la demanda de atención médica.

        Atención a Grupos Vulnerables: Los hospitales que atienden a poblaciones desfavorecidas o marginadas a menudo enfrentan desafíos adicionales para proporcionar atención médica adecuada. Las donaciones pueden ayudar a abordar estas disparidades al proporcionar recursos adicionales para garantizar que todos tengan acceso a atención médica de calidad.

        Mejora de la Infraestructura: Los hospitales a menudo necesitan actualizar su infraestructura, como la renovación de instalaciones obsoletas, la compra de equipos médicos modernos y la mejora de la capacidad de atención. Las donaciones pueden permitir que los hospitales realicen estas mejoras, lo que a su vez beneficia a los pacientes al ofrecer un entorno más seguro y cómodo para recibir atención médica. -->
        </p>
        <a href="../HTML/AcercaDe.php" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out">Leer Más Sobre Nosotros</a>
      </div>
    </section>

  <div class="flex min-h-screen items-center justify-center p-10 bg-white">
  <div class="container grid max-w-screen-xl gap-8 lg:grid-cols-2 lg:grid-rows-2">
    <div class="row-span-2 flex flex-col rounded-md border border-slate-200">
      <div class="h-1/2 flex-1"><img src="../Imagenes/3.jpeg" class="w-full object-cover object-right-top rounded-l-sm rounded-r-sm" alt="omnichannel" style="padding-top: 0; height: 356px;"></div>
      <div class="p-10">
        <h3 class="text-xl font-medium text-gray-700">Respuesta a emergencias:</h3>
        <p class="mt-2 text-slate-500 text-justify" style="padding-bottom: 50px;">En situaciones de emergencia, como desastres naturales o epidemias, los hospitales pueden verse abrumados por la demanda de atención médica. Las donaciones permiten a los hospitales estar mejor preparados para responder a estas situaciones críticas al proporcionar los recursos necesarios para manejar un aumento repentino en la demanda de atención médica.</p>
      </div>
    </div>
    <div class="flex rounded-lg border border-slate-200">
      <div class="flex-1 p-10">
        <h3 class="text-xl font-medium text-gray-700">Atención a grupos vulnerables:</h3>
        <p class="mt-2 text-slate-500 text-justify">Los hospitales que atienden a poblaciones desfavorecidas o marginadas a menudo enfrentan desafíos adicionales para proporcionar atención médica adecuada. Las donaciones pueden ayudar a abordar estas disparidades al proporcionar recursos adicionales para garantizar que todos tengan acceso a atención médica de calidad.</p>
      </div>

      <div class="relative hidden h-full w-1/3 overflow-hidden lg:block">
        <div class="absolute inset-0">
          <img src="../Imagenes/2.png" class="h-full w-full object-cover object-left-top rounded-r-lg" alt=""/>
        </div>
      </div>
    </div>
    <div class="flex rounded-lg border border-slate-200">
      <div class="flex-1 p-10">
        <h3 class="text-xl font-medium text-gray-700">Mejora de la infraestructura:</h3>
        <p class="mt-2 text-slate-500 text-justify">Los hospitales a menudo necesitan actualizar su infraestructura, como la renovación de instalaciones obsoletas, la compra de equipos médicos modernos y la mejora de la capacidad de atención. Las donaciones pueden permitir que los hospitales realicen estas mejoras, lo que a su vez beneficia a los pacientes al ofrecer un entorno más seguro y cómodo para recibir atención médica.</p>
      </div>

      <div class="relative hidden h-full w-1/3 overflow-hidden lg:block">
        <div class="absolute inset-0">
          <img src="../Imagenes/4.jpg" class="h-full w-full object-cover object-left-top rounded-r-md" alt=""/>
        </div>
      </div>
    </div>
  </div>
</div>
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
    <p class="text-lg font-bold">SaludRural</p>
    <p class="text-sm mt-2 mb-4">Si deseas saber más información sobre nosotros, puedes buscarnos y contactarnos en nuestras redes sociales.</p>
    <div class="flex justify-center space-x-4 mb-4">
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
    </div>
    <ul class="flex items-center justify-center space-x-4">
      <li><a href="../HTML/Index.php" class="text-gray-400 hover:text-white"><strong>Inicio</strong></a></li>
      <li><a href="../HTML/boton-donaciones.php" class="text-gray-400 hover:text-white">Donaciones</a></li>
      <li><a href="../HTML/blog.php" class="text-gray-400 hover:text-white">Blog</a></li>
      <li><a href="../HTML/AcercaDe.php" class="text-gray-400 hover:text-white">Acerca de</a></li>
    </ul>
    <div class="footer-bottom">
     <p><small id="26">&copy; 2023 <b>Salud Rural</b> - Todos los Derechos Reservados.</small></p>
 </div>
</footer>

  </body>
</html>
