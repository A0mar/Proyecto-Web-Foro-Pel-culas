<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Omar Alonso">
    <meta name="Author" content="Pedro Merino">
    <title>Buscador Entrada</title>
    <link rel="stylesheet" href="css/buscar.css">
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
        <h1>Información relacionada con la película</h1>
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
                    $nombre = $_POST["nombre"];

                    //Realizar sentencia Select 
                    $ConsultaSelect = "SELECT * FROM Peliculas WHERE nombre = ? AND premios = 0";
                    $stmt = $conexion->prepare($ConsultaSelect);
                    $stmt->bind_param("s", $nombre);
                    // Ejecutar la sentencia
                    $stmt->execute();
                    //Obtener resultado
                    $resultado = $stmt->get_result();

                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<h2>" . $fila["nombre"] . "</h2>";
                        echo "<p>" .$fila["descripcion"]. "</p>";
                        echo "<p>" .$fila["fecha_estreno"]. "</p>";
                        echo "<p>" .$fila["genero"]. "</p>";
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
</body>