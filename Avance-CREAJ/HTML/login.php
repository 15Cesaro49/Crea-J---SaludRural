<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <script
      src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../CSS/traductor-login.css">
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="shortcut icon" href="../Imagenes/favicon.png"/>
    <title>Formularios</title>
  </head>
  <body>
    
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="../php/login.php" class="sign-in-form" method="post" autocomplete="off">
            <h2 class="title">Inicio de sesión</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Correo electrónico" name="correo" required>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
                <input type="password" placeholder="Contraseña" name="contra">
            </div>
            <input type="submit" value="INGRESAR" class="btn solid">
          </form>
          <form action="../php/registro.php" class="sign-up-form" method="post" autocomplete="off">
            <h2 class="title">Regístrate</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nombre" name="nombre" required>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Apellido" name="apellidos" required>
              </div>
              <div class="input-field">
                <i class="fas fas fa-phone"></i>
                <input type="tel" placeholder="Teléfono" name="telefono" minlength="8" maxlength="11" required>
                </div>
                <div class="input-field">
                  <i class="fas far fa-id-card"></i>
                  <input type="tel" placeholder="DUI" name="dui" minlength="10" maxlength="12" required>
                  </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Correo electrónico" name="email" required>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
                <input type="password" placeholder="Contraseña" name="contra" required>
            </div>
                <input type="submit" class="btn" value="CREAR CUENTA">
          </form>
        </div>
      </div>
      
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <div id="google_translate_element"></div>
            
             <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <!--DIV DEL TRADUCTOR-->
            <div class="md:relative md:left-5-4" id="google_translate_element"></div>
            
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
        <!--FIN DEL SCRIPT DEL TRADUCTOR DE GOOGLE-->
            <h3>¿Nuevo aquí?</h3>
            <p>
            ¡Regístrate ahora!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              REGISTRARME
            </button>
          </div>
          <img src="../IMAGENES/mano.png" class="image" alt="">
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>¿Ya tienes cuenta?</h3>
            <p>
              ¡Inicia sesión y haz tu donación ahora!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Iniciar sesión
            </button>
          </div>
          <img src="../IMAGENES/mano-login.png" class="image" alt="">
        </div>
      </div>
    </div>


    <script src="../JS/app.js"></script>
    
  </body>
</html>

