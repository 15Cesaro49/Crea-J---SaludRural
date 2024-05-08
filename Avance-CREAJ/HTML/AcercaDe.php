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
<html lang="es">
    <head>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    </head>
   
  <body class="bg-gray-100">
  <nav class="bg-white p-4  w-full z-10 ">
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
                <li><a class="text-black hover:bg-blue-600 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-pointer">Acerca de</a></li>
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

  <!-- Código del slider (portada) -->
  <section class="bg-blue-600 text-white py-24">
    <div class="container mx-auto text-center">
      <h1 class="text-4xl font-bold mb-4" style="font-size: 950;">¡Ayúdanos a mejorar la salud en zonas rurales!</h1>
      <p class="text-lg mb-8" style="font-size: larger;">Tu generosa donación, marca la diferencia en la vida de quiénes más lo necesitan.</p>
      <a href="../HTML/boton-donaciones.php" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out">Realizar donación</a>
    </div>
  </section>

  <!-- Código del cuerpo (información) de la página -->
  <div class="container mx-auto p-8 pt-1">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
      <div class=" p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Sobre Nosotros</h2>
        <p class="text-gray-600 text-justify">Somos una organización que busca ayudar a la sociedad más necesitada de nuestro país <span class="font-bold">"El Salvador"</span>, a través de donaciones para hospitales y centros médicos que se encuentran en las zonas rurales del país, es decir, las comunidades marginadas y abandonadas que existen en todo el territorio nacional.</p>
        <img src="../Imagenes/CajaDonativos.png" class="mx-auto mt-6 rounded-lg" width="335" height="315" alt="imagen">
      </div>
      <div class="p-4 bg-white rounded-lg shadow-md">
        <p class="text-gray-600 text-justify">Nuestro equipo está conformado por profesionales apasionados y comprometidos con la salud pública y la equidad en la atención médica. Trabajamos en estrecha colaboración con hospitales y centros médicos en áreas rurales para comprender sus necesidades y brindarles el apoyo necesario. Valoramos la transparencia y la responsabilidad en nuestro trabajo. Nos esforzamos por mantener una comunicación clara con nuestros donantes y socios, proporcionándoles actualizaciones sobre cómo se utilizan sus contribuciones y el impacto que están generando.</p><br>
        <p class="text-gray-600 text-justify">En <span class="font-bold">SaludRural</span>, creemos firmemente en el poder de la solidaridad y la generosidad. A través de nuestra plataforma, permitimos a personas y organizaciones donar de manera segura y directa a proyectos y necesidades específicas de los hospitales y centros médicos rurales. Facilitamos la conexión entre donantes y receptores, asegurando que cada donación tenga un impacto significativo y positivo en la vida de las personas. Estamos emocionados de ser parte del cambio y el progreso en la atención médica de las zonas rurales. <a href="../HTML/login.php"><span class="negra">Únete a nosotros en SaludRural</span></a> y juntos hagamos la diferencia en la salud y el bienestar de las comunidades rurales de nuestro país.</p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
      <div class=" p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Misión</h2>
        <p class="text-gray-600 text-justify">Ser una organización que promueva y facilite las donaciones a hospitales y centros médicos ubicados en zonas rurales del país. <strong class="strongT">SaludRural</strong> se compromete a conectar de manera efectiva a los donantes con estas instituciones, brindando una plataforma segura y transparente para canalizar recursos y apoyar la atención médica en las comunidades más remotas y marginadas de todo el territorio nacional. Por último, impulsar un cambio significativo en la salud, promoviendo la equidad y la mejora de la calidad de vida de quienes más lo necesitan.</p>
      </div>
      <div class="p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Visión</h2>
        <p class="text-gray-600 text-justify">Queremos lograr ser una organización líder en el ámbito de las donaciones a hospitales y centros médicos en zonas rurales del país. Nos esforzamos por ser el referente principal para aquellos que deseen contribuir al bienestar de las comunidades rurales a través de donaciones significativas y de impacto. Buscamos establecer alianzas sólidas con hospitales y centros médicos, así como con donantes comprometidos, para construir en un futuro una cultura de equidad, y que el acceso a la atención médica sea una realidad para todos, sin importar su ubicación geográfica. Aspiramos a ser reconocidos como un agente de cambio en la atención médica rural, mejorando la calidad de vida de las personas y generando un impacto duradero en la salud de la población salvadoreña.</p>
      </div>
      <div class="p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Nuestros valores</h2>
        <h3 class="mb-3 text-justify px-2">A continuación, se presentan los valores fundamentales que guían nuestro trabajo en SaludRural.</h3>
        <p class="text-gray-600 px-3 text-justify mb-1"><span class="text-gray-600 text-justify font-bold">- Transparencia:</span> En Salud Rural poseemos una confianza cultivada a través de la apertura y honestidad.</p>
        <p class="text-gray-600 px-3 text-justify mb-1"><span class="text-gray-600 text-justify font-bold">- Compromiso:</span> Tenemos una dedicación inquebrantable para empoderar comunidades, asegurando su bienestar y salud a través de acciones sólidas y continuas.</p>
        <p class="text-gray-600 px-3 text-justify mb-1"><span class="text-gray-600 text-justify font-bold">- Solidaridad:</span> Extendemos una mano amiga para fortalecer y apoyar a nuestras comunidades en su camino hacia una vida más saludable y plena.</p>
        <p class="text-gray-600 px-3 text-justify mb-1"><span class="text-gray-600 text-justify font-bold">- Equidad:</span> Garantizamos que cada individuo tenga acceso igualitario a oportunidades de salud y bienestar.</p>
      </div>
    </div>
  </div>

  <div class="flex flex-col md:flex-row mb-14">
    <div class="bg-gray-200 p-4 md:w-1/3 rounded-lg ml-8 mr-4">
      <div class="bg-blue-600 py-1 px-3 rounded-t-lg rounded-b-lg">
        <p class="font-bold text-justify" style="font-size: larger; color: #E9E9E9;">Historia de SaludRural</p>
      </div>
        <p class="mt-4 mb-6 text-justify text-gray-700"><strong class="text-green-800">SaludRural</strong> nació como una idea en común de 5 estudiantes del <a href="https://www.cdb.edu.sv/" class="hover:text-green-800 hover:underline"><strong>Colegio Don Bosco</strong></a>, estos estudiantes son: Xavier Zañas, Carlos López, David Murgas, César Serrano y Julio Jacinto. Estos jóvenes compartían una pasión común por ayudar a los demás y siempre estaban buscando formas de marcar una diferencia positiva en la sociedad.</p>
        <p class="text-justify mb-1 text-gray-700">Un día, mientras se reunían en la biblioteca de la escuela para trabajar en un proyecto conjunto, surgió una idea que iluminó sus mentes. Se dieron cuenta de que muchas comunidades rurales cercanas carecían de acceso adecuado a servicios de salud, y esto les preocupaba profundamente. Decidieron unir fuerzas y crear una solución que pudiera marcar la diferencia en la vida de las personas en estas áreas.</p>
    </div>
    <div class="bg-gray-200 p-4 md:w-1/3 rounded-lg mr-4">
      <p class="mb-6 text-justify text-gray-700">Así nació <strong class="text-green-800">SaludRural</strong>, una organización sin fines de lucro con una visión clara: facilitar las donaciones a hospitales y centros médicos en zonas rurales a través de una plataforma web. Los cinco estudiantes se dedicaron por completo a este proyecto, invirtiendo su tiempo, esfuerzo y conocimientos en su desarrollo.</p>
      <p class="text-justify text-gray-700">Trabajaron arduamente para diseñar y construir una plataforma intuitiva y segura donde las personas pudieran realizar donaciones de manera fácil y transparente. Sabían que la confianza de los donantes era fundamental, por lo que se aseguraron de establecer medidas de seguridad robustas para proteger la privacidad y la integridad de las transacciones.</p>
    </div>
    <div class="bg-gray-300 p-4 md:w-1/3 rounded-lg mr-8">
      <p class="text-justify mb-6 text-gray-700">La historia de <strong>SaludRural</strong> se convirtió en un ejemplo de cómo una simple idea, impulsada por la pasión y el deseo de ayudar, puede transformarse en una fuerza poderosa para el cambio. Los cinco estudiantes demostraron que no importa cuán jóvenes sean, si tienen una visión y trabajan juntos, pueden marcar una diferencia significativa en la sociedad.</p>
      <p class="text-justify text-gray-700">Hasta el día de hoy, SaludRural continúa su labor, creciendo y expandiéndose para llevar esperanza y mejorar la calidad de vida de las comunidades rurales a través de la solidaridad y la generosidad de aquellos que creen en su misión.</p>
    </div>
  </div>
</body>

    <!-- Código del footer -->
    <footer class="bg-gray-800 text-center text-white py-8">
      <div class="container mx-auto">
        <p class="text-lg font-bold">SaludRural</p>
        <p class="text-sm mt-2 mb-4">Si deseas saber más información sobre nosotros, puedes buscarnos y contactarnos en nuestras redes sociales.</p>

        <div class="flex justify-center space-x-4 mb-4">
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
        </div>

        <ul class="flex items-center justify-center space-x-4">
          <li><a href="../HTML/Index.php" class="text-gray-400 hover:text-white"><strong>Inicio</strong></a></li>
          <li><a href="../HTML/boton-donaciones.php" class="text-gray-400 hover:text-white">Donaciones</a></li>
          <li><a href="../HTML/blog.php" class="text-gray-400 hover:text-white">Blog</a></li>
          <li><a href="../HTML/AcercaDe.php" class="text-gray-400 hover:text-white">Acerca de</a></li>
        </ul>
      </div>

      <div class="footer-bottom">
        <p><small id="26">&copy; 2023 <b>Salud Rural</b> - Todos los Derechos Reservados.</small></p>
      </div>
    </footer>
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
</html>