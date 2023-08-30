<!DOCTYPE html>
<html lang="es">
    <body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include("conex.php");
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$dui = $_POST['dui'];
$contra = $_POST['contra'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "
    <script language='JavaScript'>
        swal.fire({
            icon: 'error',
            title: 'Correo electrónico inválido',
            text: 'El correo electrónico no es válido.',
            showConfirmButton: false,
            timer: 3000
        }).then(function() {
            window.location = '../HTML/login.php';
        });
    </script>
    ";
    exit; // Detener la ejecución del script si el correo es inválido
}
$sql= "INSERT INTO `registro`(`id`, `nombre`, `apellidos`, `telefono`, `correo`, `dui`, `contra`) VALUES (NULL, '$nombre', '$apellidos','$telefono','$email','$dui','$contra')";

$resultado = mysqli_query($conn,$sql);
mysqli_close($conn);
if ($resultado) {
    echo "
    <script language='JavaScript'>
        swal.fire({
            icon: 'success',
            title: 'Te haz registrado correctamente',
            showConfirmButton: false,
            timer: 2000
        }).then(function() {
            window.location = '../HTML/login.php';
        });
    </script>
    ";
}else{
    echo "
    <script language='JavaScript'>
        swal.fire({type: 'success',
            title: 'Mal!'
        }).then(function() {
            window.location = '../HTML/login.php';
        });
    </script>
    ";
}
    
?> 
</body>
</html>

