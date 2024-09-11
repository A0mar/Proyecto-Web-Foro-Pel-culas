<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Entrada</title>
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
    $calificacion = $_POST["calificacion"];
    $comentario = $_POST["comentario"];
    $nombrePelicula = $_POST["nombrePelicula"];
    //Asociamos la variable sesion 
    $ID_usuario = $_SESSION["ID_usuario"];


    // Realizar consulta SQL
    $sentenciaInsert = $conexion->prepare("INSERT INTO Opiniones (ID_usuario, calificacion, comentario, nombrePelicula, fecha_opinion) VALUES (?, ?, ?, ?, NOW())");
    
    // Asociar parámetros de entrada
    $sentenciaInsert->bind_param("iiss", $ID_usuario, $calificacion, $comentario, $nombrePelicula);
    
    // Comprobar si se ha ejecutado la sentencia correctamente
    if ($sentenciaInsert->execute()) {
        echo "Nuevo comentario realizado con éxito";
        echo "<a href='../index.php'>Volver a la página principal</a>";
    } else {
        echo "Error al dar de alta la nueva opinión " . $sentenciaInsert->error;
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