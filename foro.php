<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Omar Alonso">
    <meta name="Author" content="Pedro Merino">
    <title>Buscador Entrada</title>
    <link rel="stylesheet" href="css/foro.css">
</head>

<body>
    <?php
    session_start();

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION["nombre"])) {
        header("Location: InicioSesion/login.php"); // Redireccionar a la página de inicio de sesión si no está autenticado
        exit();
    }
    ?>
    <header>
        <h1>Foro de MovieSocial</h1>
    </header>
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

                    // Mostrar opiniones del propio usuario y de otros usuarios, Realizamos un LEFT JOIN  para consultar dos tablas
                    $consultaOpiniones = "SELECT opi.*, usu.nombre FROM Opiniones opi LEFT JOIN Usuarios usu ON opi.ID_usuario = usu.ID_usuario WHERE opi.ID_usuario = ? OR opi.ID_usuario <> ?";
                    $stmtOpiniones = $conexion->prepare($consultaOpiniones);
                    $stmtOpiniones->bind_param("ii", $ID_usuario, $ID_usuario);
                    $stmtOpiniones->execute();
                    $resultadoOpiniones = $stmtOpiniones->get_result();

                    // Mostrar resultados
                    echo "<ul>";
                    while ($fila = $resultadoOpiniones->fetch_assoc()) {
                        echo "<li>";
                        echo "<p>"  .$fila["nombre"] . "</p>";
                        echo "<p>" . $fila["comentario"] . "</p>";
                        echo "<p>" . $fila["calificacion"] . "</p>";
                        echo "<p>" . $fila["nombrePelicula"] . "</p>";
                        echo "<p>" . $fila["fecha_opinion"] . "</p>";
                        echo "</li>";
                    }
                    echo "</ul>";


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

    </article>
    </section>
    </main>
    <footer>
        <p class="nombre">Autores: Omar Alonso, Pedro Manuel Merino</p>
        <p class="extra">&copy; <?php echo date("Y"); ?> - MovieSocial </p>
    </footer>
</body>

</html>
</body>