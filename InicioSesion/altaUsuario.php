<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Pedro Merino">
    <meta name="Author" content="Omar Alonso">
    <link rel="stylesheet" href="../css/altaUsuario.css">
    <title>Alta de un Usuario</title>
</head>
<body>
    <?php
    try {
         //Hacer conexion a la Base de Datos
        $conexion = new mysqli('localhost', 'administradorOmar', 'Clave_00', 'cine');
        // En caso de error
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        // Obtener los datos del registro del formulario 
        $nombre = $_POST["nombre"];
        $contrasena = $_POST["contrasena"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];

        //Hacer el registro en la tabla Usuario
        $sentenciaInsert = $conexion->prepare("INSERT INTO usuarios (nombre, contrasena, correo, telefono) VALUES (?,?,?,?)");

        //Enlazar parámetros
        $sentenciaInsert->bind_param("ssss", $nombre,$contrasena,$correo,$telefono);

        //Comprobar que el Insert que se ha ejecutado correctamente
        if ($sentenciaInsert->execute()) {
            echo "Usuario dado de alta con exito.";
            echo "<br>";
            echo '<a href="login.php">Pulsa aquí para iniciar sesion</a>';
        } else {
            echo "Error al dar de alta al nuevo usuario: " . $sentenciaInsert->error;
            echo "<br>";
            echo '<a href="registrar.php">¿Desea volver a registrarse?</a>';
        }
    }
    //Comprobar si se ha establecido conexión o ha pasado algún error.
    catch (mysqli_sql_exception $excp) {
        if ($conexion->connect_errno) {
            die("Falló la conexión: " . $conexion->connect_error);
        } else {
            die('Algo ha fallado en la BBDD: ' . $conexion->error);
        }
    }
    ?>
</body>
</html>