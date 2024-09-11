<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Perfil</title>
</head>
<body>
<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["nombre"])) {
    header("Location: ../InicioSesion/login.php"); // Redireccionar a la página de inicio de sesión si no está autenticado
    exit();
}

//Conexión a la base de datos
try {
    //Establecer conexión con la BD 
    $conexion = new mysqli('localhost', 'administradorOmar', 'Clave_00', 'cine');
    // Verificar conexión
    if ($conexion->connect_error) {
        die("Fallo en la conexión: " . $conexion->connect_error);
    } 

    //Obtener datos de los input del formulario
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $contrasena = $_POST["contrasena"];
    
    // Realizar consulta SQL
    $sentenciaUpdate = $conexion->prepare("UPDATE Usuarios SET nombre = ?, correo = ?, telefono = ?, contrasena = ? WHERE nombre = ?");
    
    // Asociar parámetros de entrada
    $sentenciaUpdate->bind_param("ssiss", $nombre, $correo, $telefono, $contrasena, $nombre);
    
    // Comprobar si se ha ejecutado la sentencia correctamente
    if ($sentenciaUpdate->execute()) {
        echo "Datos del usuario modificados con éxito";
        echo "<a href='../index.php'>Volver a la página principal</a>";
    } else {
        echo "Error al modificar los datos " . $sentenciaUpdate->error;
    }
    
    // Cerrar conexión
    $conexion->close();
} catch (mysqli_sql_exception $ex) {
    // Gestión de errores
    if ($conexion->connect_error) {
        die("Fallo en la conexión" . $conexion->connect_error);
    } else {
        die("Algo ha fallado en la BD" . $conexion->error);
    }
}
?>

</body>
</html>