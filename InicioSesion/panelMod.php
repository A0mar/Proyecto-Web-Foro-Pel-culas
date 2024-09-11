<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Pedro Merino">
    <meta name="Author" content="Omar Alonso">
    <link rel="stylesheet" href="../css/misValoraciones.css">
    <title>Panel Moderador</title>
</head>

<body>
    <?php
    session_start(); // Creamos una sesión

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION["nombre"])) {
        header("Location: login.php"); // Redireccionar a la página de inicio de sesión si no está autenticado
        exit();
    }
    try {
        // Establecemos la conexión a la BD
        $conexion = new mysqli('localhost', 'administradorOmar', 'Clave_00', 'cine');
        // Controlamos los errores
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        } ?>

        <table border="1">
            <tr>
                <th>Nombre de Usuario:</th>
                <th>Acciones</th>
            </tr>

            <?php
             //$ID_usuario = $_SESSION["ID_usuario"];

            // Realizamos la consulta SQL
            $sentenciaSelect = $conexion->prepare("SELECT * FROM Usuarios");
            //$sentenciaSelect->bind_param("i", $ID_usuario);
            // Ejecutamos la sentencia
            $sentenciaSelect->execute();
            $resultado = $sentenciaSelect->get_result();
            // Creamos un bucle para mostrar los resultados
            while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
            <td>" . $fila["nombre"] . "</td>
            <td>";
            ?>
                <form action="borrarUsu.php" method="post">
                    <!--<input type="hidden" name="nombre" value="<?php //echo $fila['nombre']; ?>">-->
                    <input type="hidden" name="ID_usuario" value="<?php echo $fila['ID_usuario']; ?>">
                    <button type="submit" name="botonBorrar">Borrar</button>
                </form>
            <?php
                echo "</td>
        </tr>";
            }
            ?>
        </table>
    <?php
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