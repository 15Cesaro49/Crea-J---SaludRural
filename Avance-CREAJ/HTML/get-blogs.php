<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
  <style>
     /* Quita el texto (Con la tecnologia de) */
div .skiptranslate.goog-te-gadget,
.goog-te-combo .dark {
  font-size: 0%;
  margin-left: 5%;
  margin-top: 0.5%;
  background-size: cover;
}

/* Quita el texto (Traductor de google) */
div .skiptranslate.goog-te-gadget span a {
  font-size: 0;
}

/* Cambia el estilo del boton para seleccionar el idioma */
div .goog-te-combo {
  color: #000000;
  font-weight: bold;
  cursor: pointer;
  padding: 10px 20px;
  -o-border-radius: 20px;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  -webkit-border-radius: 20px;
  -moz-border-radius: 30px;
  -ms-border-radius: 20px;
  border-radius: 10px;
}

div .goog-te-combo:hover{
  background-color: rgba(27, 94, 238, 0.911);
  color: #ffffff;
}

/* Cambia el tamaño y mueve la parte azul del traductor*/
.VIpgJd-ZVi9od-ORHb-OEVmcd.skiptranslate,
.VIpgJd-ZVi9od-ORHb {
  width: 55%;
  top: 1.3%;
  left: -70%;
}

/* Cambia el estilo de la lista de idiomas del menú del traductor */
.goog-te-combo option {
  background: #ffffff;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-weight: bold;
  color: #000000;
  -webkit-o-border-radius: 10px;
  -moz-o-border-radius: 10px;
  -ms-o-border-radius: 10px;
}

/* Hace invisible la imagen de "Google" */
a img {
  width: 0;
}
  </style>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
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
<?php
session_start();
include("../PHP/conex.php");

if (isset($_GET['id'])) {
    $blogId = $_GET['id'];
    $sql = "SELECT id, titulo, contenido, imagen FROM blogs WHERE id = $blogId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md hover:shadow-lg transition duration-300">';
        echo '<img src="' . $row['imagen'] . '" alt="Imagen del artículo" class="w-full h-32 object-cover">';
        echo '<div class="p-4">';
        echo '<h2 class="text-xl font-semibold text-indigo-600 mb-2">' . $row['titulo'] . '</h2>';
        echo '<p class="text-gray-700">' . $row['contenido'] . '</p>';
        echo '<a href="../HTML/blog.php" class="block text-center text-indigo-600 mt-4 hover:underline">Volver a la lista de blogs</a>';
        echo '</div>';
        echo '</div>';
        
        // Mostrar formulario de comentarios si el usuario está registrado
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            echo '<div class="max-w-md mx-auto mt-4 bg-white rounded-md p-4 shadow-md">';
            echo '<h3 class="text-lg font-semibold mb-2">Añadir Comentario:</h3>';
            echo '<form action="agregar_comentario.php" method="post">';
            echo '<input type="hidden" name="blog_id" value="' . $blogId . '">';
            echo '<textarea name="comentario" id="comentario" rows="4" class="border rounded-md px-2 py-1 focus:outline-none focus:border-blue-500" required></textarea>';
            echo '<button type="submit" class="mt-2 bg-blue-500 text-white px-2 py-1 rounded">Agregar Comentario</button>';
            echo '</form>';
            echo '</div>';
        } else {
            echo '<p>Inicia sesión para agregar comentarios.</p>';
        }
        
        // Mostrar comentarios
        $comentariosSql = "SELECT id, contenido, user_id
                          FROM comentarios
                          WHERE blog_id = $blogId";
        $comentariosResult = $conn->query($comentariosSql);
        
        if ($comentariosResult !== false && $comentariosResult->num_rows > 0) {
            echo '<div class="max-w-md mx-auto mt-4 bg-white rounded-md p-4 shadow-md">';
            echo '<h3 class="text-lg font-semibold mb-2">Comentarios:</h3>';
            
            while ($comentario = $comentariosResult->fetch_assoc()) {
                echo '<div class="bg-gray-100 p-2 rounded-md mb-2">';
                echo '<p>' . $comentario['contenido'] . '</p>';
                echo '</div>';
            }
            
            echo '</div>';
        } else {
            echo '<p>No hay comentarios para este blog.</p>';
        }
        
    } else {
        echo 'No se encontró el blog.';
    }
} else {
    echo 'ID de blog no proporcionado.';
}
?>
</body>
</html>
