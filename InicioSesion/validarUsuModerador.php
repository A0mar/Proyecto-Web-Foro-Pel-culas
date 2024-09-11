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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtenemos los datos del formulario
    $usuario = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    try {
        // Establecemos la conexión a la BD
        $conexion = new mysqli('localhost', 'administradorOmar', 'Clave_00', 'cine');
        // Controlamos los errores
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        // Preparacion consulta SQL
        $sentenciaSelect = "SELECT ID_moderador, nombre, contrasena FROM moderadores WHERE nombre = ? AND contrasena = ?";
        $stmt = $conexion->prepare($sentenciaSelect);
        $stmt->bind_param("ss", $usuario, $contrasena);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Ver si hay resultado
        if ($resultado->num_rows > 0) {
            $usuarioDatos = $resultado->fetch_assoc();
            $_SESSION["ID_moderador"] = $usuarioDatos["ID_moderador"];
            $_SESSION["nombre"] = $usuarioDatos["nombre"];
            header("Location: panelMod.php");
            exit();
            
        } else {
            // Si no coincide la contraseña y el nombre de usuario, mostramos un mensaje de error
            echo "Error: Nombre de usuario o contraseña incorrectos";
            echo '<a href="login.php">Volver a inicio de sesión</a>';
        }
        $conexion->close();
    } catch (mysqli_sql_exception $excp) {
        if ($conexion->connect_errno) {
            die("Falló la conexión: " . $conexion->connect_error);
        } else {
            die('Algo ha fallado en la BBDD: ' . $conexion->error);
        }
    }
} else {
    // Si no se ha enviado el formulario, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
?>

</body>
</html>
