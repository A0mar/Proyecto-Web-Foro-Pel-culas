<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Omar Alonso">
    <meta name="Author" content="Pedro Merino">
    <link rel="stylesheet" href="">
    <script src="confirmarEliminar.js"></script>
    <title>Perfil Usuario</title>
    <link rel="stylesheet" href="../css/miPerfil.css">
</head>

<body>
    <?php
    session_start();

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION["nombre"])) {
        header("Location: ../InicioSesion/login.php"); // Redireccionar a la página de inicio de sesión si no está autenticado
        exit();
    }
    ?>
    <header>
        <h1>Mi Perfil</h1>
    </header>
    <nav>
        <form action="editarPerfil.php" method="post">
            <input class="boton" type="submit" value="Editar perfil">
        </form>
        <?php  
        $ID_usuario = $_SESSION["ID_usuario"];
        ?>
        <form action="eliminarPerfil.php" method="post">
             <!--Creamos un boton invisible para coger el valor-->
             <input type="hidden" name="ID_usuario" id="ID_usuario" value="<?php echo $ID_usuario; ?>">
            <input class="boton" type="submit" value="Eliminar mi cuenta"  onclick="return confirmarEliminar()">
        </form>
    </nav>
    <main>
        <section>
            <article>
                <?php
                //Conexión a la BD
                try {
                    //Establecer conexion con la BD 
                    $conexion = new mysqli('localhost', 'root', '', 'cine');

                    // Verificar conexión
                    if ($conexion->connect_error) {
                        die("Fallo en la conexión: " . $conexion->connect_error);
                    }

                    //Asociamos la variable de sesion 
                    $ID_usuario = $_SESSION["ID_usuario"];

                    //Realizar sentencia Select 
                    $ConsultaSelect = "SELECT * FROM Usuarios WHERE ID_usuario = ?";
                    $stmt = $conexion->prepare($ConsultaSelect);
                    $stmt->bind_param("s", $ID_usuario);
                    // Ejecutar la sentencia
                    $stmt->execute();
                    //Obtener resultado
                    $resultado = $stmt->get_result();

                    while ($fila = $resultado->fetch_assoc()) {
                        echo "Nombre: " . $fila["nombre"];
                        echo "<br>";
                        echo "Correo: " . $fila["correo"];
                        echo "<br>";
                        echo "Telefóno: " .$fila["telefono"];
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
            </article>
        </section>
    </main>
    <footer>
        <p class="nombre">Autores: Omar Alonso, Pedro Manuel Merino</p>
        <p class="extra">&copy; <?php echo date("Y"); ?> - MovieSocial </p>
    </footer>
</body>

</html>