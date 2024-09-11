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

                    //Coger el input del formulario 
                    $ID_opinion = $_POST['ID_opinion'];

                    //Realizar sentencia SQL
                    $sentenciaDelete = $conexion->prepare("DELETE FROM Opiniones WHERE ID_opinion = ?");
                    //Enlazar parámetros
                    $sentenciaDelete->bind_param("i", $ID_opinion);
                    if ($sentenciaDelete->execute()) {
                        echo header("Location: misValoraciones.php"); //Redireccionar a misValoraciones
                    } else {
                        echo "Error al eliminar los datos de la entrada: " . $sentenciaDelete->error;
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