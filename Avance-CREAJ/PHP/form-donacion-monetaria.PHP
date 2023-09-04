<!DOCTYPE html>
<html lang="es">
    <body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene un usuario_id válido
if (isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id'])) {
    // Obtener el id_hospital seleccionado del formulario
    if (isset($_POST['hospital'])) {
        $id_hospital = $_POST['hospital'];
        $usuarioId = $_SESSION['usuario_id'];
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $fecha = $_POST["fecha"];
        $monto = $_POST["monto"];
        $tarjeta = $_POST["tarjeta"];
        $cvv = $_POST["cvv"];

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

        // Preparar la consulta para insertar la donación en la tabla 'donaciones'
        $sql = "INSERT INTO monetaria (id_hospital, id_usuario, `nombre`, `correo`, `telefono`, `fecha`, `monto`, `tarjeta`, `cvv`) VALUES ('$id_hospital', '$usuarioId', '$nombre','$correo','$telefono','$fecha','$monto','$tarjeta', '$cvv')";

        if ($conn->query($sql) === TRUE) {
            echo "
            <script language='JavaScript'>
                swal.fire({
                    icon: 'success',
                    title: '¡Tu formulario se ha registrado exitosamente!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location = '../HTML/boton-donaciones.php';
                });
            </script>";
        } else {
            echo "Error al realizar la donación: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    }
} else {
    echo "Debe iniciar sesión para realizar una donación...";
}
?>
</body>
</html>
