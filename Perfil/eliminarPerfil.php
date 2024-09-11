<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <meta name="Author" content="Pedro Merino">
    <meta name="Author" content="Omar Alonso">
    <title>Borrar Entrada</title>
</head>

<body>
    <header>

    </header>
    <main>
        <section>
            <article>
                <?php

                session_start();

                // Verificar si el usuario está autenticado
                if (!isset($_SESSION["nombre"])) {
                    header("Location: ../InicioSesion/login.php"); // Redireccionar a la página de inicio de sesión si no está autenticado
                    exit();
                }
                //Conexión a la BD
                try {
                    //Establecer conexion con la BD 
                    $conexion = new mysqli('localhost', 'root', '', 'cine');

                    // Verificar conexión
                    if ($conexion->connect_error) {
                        die("Fallo en la conexión: " . $conexion->connect_error);
                    }

                    // Coger el input del formulario
                    $ID_usuario = $_POST['ID_usuario'];

                    // Realizar sentencia SQL para eliminar registros en Opiniones asociados al usuario, (CLAVE FORANEA)
                    $sentenciaDeleteOpiniones = $conexion->prepare("DELETE FROM Opiniones WHERE ID_usuario = ?");
                    $sentenciaDeleteOpiniones->bind_param("i", $ID_usuario);
                    $sentenciaDeleteOpiniones->execute();

                    // Realizar sentencia SQL para eliminar el usuario
                    $sentenciaDeleteUsuario = $conexion->prepare("DELETE FROM Usuarios WHERE ID_usuario = ?");
                    $sentenciaDeleteUsuario->bind_param("i", $ID_usuario);

                    if ($sentenciaDeleteUsuario->execute()) {
                        session_destroy(); // Cerramos la sesión y redirigimos al login
                        header("Location: ../InicioSesion/login.php"); // Redireccionar a misValoraciones
                    } else {
                        echo "Error al eliminar los datos del usuario: " . $sentenciaDeleteUsuario->error;
                    }

                    // Cerrar conexión
                    $conexion->close();


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