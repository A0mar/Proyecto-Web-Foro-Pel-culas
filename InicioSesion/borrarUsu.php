<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Pedro Merino">
    <meta name="Author" content="Omar Alonso">
    <title>Validar Moderador</title>
</head>

<body>
    <?php
    session_start(); // Creamos una sesión
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION["nombre"])) {
        header("Location: login.php"); // Redireccionar a la página de inicio de sesión si no está autenticado
        exit();
    }
    // Obtenemos los datos del formulario
    $ID_usuario = $_POST['ID_usuario'];
    //$nombre = $_POST['nombre'];

    try {
        // Establecemos la conexión a la BD
        $conexion = new mysqli('localhost', 'administradorOmar', 'Clave_00', 'cine');
        // Controlamos los errores
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
         // Realizar sentencia SQL para eliminar registros en Opiniones asociados al usuario, (CLAVE FORANEA)
         $sentenciaDeleteOpiniones = $conexion->prepare("DELETE FROM Opiniones WHERE ID_usuario = ?");
         $sentenciaDeleteOpiniones->bind_param("i", $ID_usuario);
         $sentenciaDeleteOpiniones->execute();

         // Realizar sentencia SQL para eliminar el usuario
         $sentenciaDeleteUsuario = $conexion->prepare("DELETE FROM Usuarios WHERE ID_usuario = ?");
         $sentenciaDeleteUsuario->bind_param("i", $ID_usuario);

         if ($sentenciaDeleteUsuario->execute()) {
            header("Location: panelMod.php"); // Redireccionar a misValoraciones
         } else {
             echo "Error al usuario: " . $sentenciaDeleteUsuario->error;
         }
        $conexion->close();
    } catch (mysqli_sql_exception $excp) {
        if ($conexion->connect_errno) {
            die("Falló la conexión: " . $conexion->connect_error);
        } else {
            die('Algo ha fallado en la BBDD: ' . $conexion->error);
        }
    }
    ?>

</body>

</html>