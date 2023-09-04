<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Donacion equipo medico</title>
    <link rel="stylesheet" href="../CSS/form-donaciones.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
<body>
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

    <a href="boton-donaciones.php">
    <button class="back-button" >
    <i class="fas fa-arrow-left"></i> Volver atras
    </button></a>
    
    <div class="container">
      <header>Donacion de equipo medico</header>
      <div class="progress-bar">
        <div class="step">
          <p>Paso 1</p>
          <div class="bullet">
            <span>1</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Paso 2</p>
          <div class="bullet">
            <span>2</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Paso 3</p>
          <div class="bullet">
            <span>3</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Fin</p>
          <div class="bullet">
            <span>4</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
      </div>
      <script>
  // Función para validar que los valores ingresados no sean negativos
  function validatePositiveNumber(inputElement) {
    const value = parseFloat(inputElement.value);
    if (isNaN(value) || value < 0) {
      swal.fire({
        icon: 'error',
        title: 'No se pueden colocar valores menores a 0',
        text: 'Por favor utiliza valores mayores a 0',
        onClose: () => {
          inputElement.value = "";  // Limpia el campo si es negativo
          inputElement.focus();     // Vuelve a enfocar el campo
        }
      });
      return false;
    }
    return true;
  }
</script>


      <div class="form-outer">
        <form action="../PHP/form-equipo-medico.php" method="post">
          <div class="page slide-page">
            <div class="field">
              <div class="label">Nombre Completo</div>
              <input type="text" name="nombre" required>
            </div>
            <div class="field">
              <div class="label">Correo Electronico</div>
              <input type="text" name="correo" required>
            </div>
            <div class="field">
              <button class="firstNext next">Siguiente</button>
            </div>
          </div>

          <div class="page">
            <div class="title">Información de Contacto</div>
            <div class="field">
              <div class="label">Número de Telefono</div>
              <input type="Number" name="telefono" required onblur="validatePositiveNumber(this)">
            </div>
            <div class="field">
             <div class="label">Fecha de la donación</div>
             <input type="datetime-local" id="fecha" name="fecha" required>
             
              <script>
              document.getElementById("fecha").addEventListener("input", function() {
                  var fechaIngresada = document.getElementById("fecha").value;
                  var fechaActual = new Date();
                  
                  // Asegurarse de que el formato de fecha sea 'YYYY-MM-DDTHH:mm'
                  fechaActual.setSeconds(0, 0); // Establecer segundos y milisegundos en cero
                  
                  if (new Date(fechaIngresada) < fechaActual) {
                    swal.fire({
                    icon: 'error',
                    title: 'La fecha debe ser presente o futura',
        });
                      document.getElementById("fecha").value = ""; // Limpiar el campo de fecha
                  }
              });
              </script>
            </div>
            <div class="field btns">
              <button class="prev-1 prev">Atrás</button>
              <button class="next-1 next">Siguiente</button>
            </div>
          </div>

          <div class="page">
            <div class="field">
              <div class="label">Nombre del equipo medico</div>
              <input type="text" name="equipo" required>
            </div>
            <div class="field">
              <div class="label">Cantidad del equipo medico</div>
              <input type="number"name="cantidad" required onblur="validatePositiveNumber(this)">
            </div>
            <div class="field btns">
              <button class="prev-2 prev">Atrás</button>
              <button class="next-2 next">Siguiente</button>
            </div>
          </div>

          <div class="page">
          <div class="field">
            <div class="label">Nombre del hospital</div>
            <select name="hospital" required>
            <?php
                // Realizar la conexión a la base de datos
                $db_host = 'localhost';
                $db_username = 'root';
                $db_password = '';
                $db_name = 'saludrural';
                $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta para obtener los hospitales desde la tabla 'tabla_hospitales'
                $sql = "SELECT id, nombre FROM hospitales";
                $result = $conn->query($sql);

                // Mostrar los nombres de los hospitales en el dropdown
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
                    }
                }

                // Cerrar la conexión
                $conn->close();
                ?>
            </select>
        </div>
            <div class="field">
              <div class="label">Descripcion del equipo medico</div>
              <input type="text" placeholder="Informacion del equipo medico" name="descripcion" required>
            </div>
            <div class="field btns">
              <button class="prev-3 prev">Atrás</button>
              <button class="submit">Enviar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script src="../JS/donaciones.JS"></script>
  </body>
</html>

