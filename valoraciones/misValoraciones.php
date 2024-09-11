<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Pedro Merino">
    <meta name="Author" content="Omar Alonso">
    <script src="confirmarBorrar.js"></script>
    <title>Mis opiniones</title>
    <link rel="stylesheet" href="../css/misValoraciones.css">
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
        <h1>Mis valoraciones</h1>
        <nav>
        <a href="../index.php">Volver a inicio</a>
    </nav>
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

                ?>
                    <table border="2">
                        <tr>
                            <th>Nombre de la Película: </th>
                            <th>Puntuación:</th>
                            <th>Comentario</th>
                            <th>Fecha de Publicación</th>
                        </tr>
                        <?php
                        //Asocimos la variable sesion a una normla
                        $ID_usuario = $_SESSION["ID_usuario"];

                        //Realizamos la consulta SQL
                        $sentenciaSelect = $conexion->prepare("SELECT * FROM Opiniones WHERE ID_usuario = ?");
                        //Asociamos parámetros de entrada
                        $sentenciaSelect->bind_param("i", $ID_usuario);
                        //Ejecutamos la sentecia
                        $sentenciaSelect->execute();
                        $resultado = $sentenciaSelect->get_result();
                        //Creamos un bucle para mostrar los resultados
                        // Crear un bucle para mostrar todos los resultados
                        while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr> 
                        <td>" . $fila["nombrePelicula"] . "</td> 
                        <td>" . $fila["calificacion"] . "</td>
                        <td>" . $fila["comentario"] . "</td>
                        <td>" . $fila["fecha_opinion"] . "</td>
                        <td>";

                        ?>
                            <!--Incrustar código HTML - Formulario con botones-->
                            <form action="borrarEntrada.php" method="post">
                                <!--Creamos un boton invisible para coger el valor-->
                                <input type="hidden" name="ID_opinion" id="ID_opinion" value="<?php echo $fila['ID_opinion']; ?>">
                                <input type="submit" value="Borrar" id="botonBorrar" onclick="return confirmarBorrar()">
                            </form>
                            <?php
                            echo "</td> <td>";
                            ?>
                            <form action="formularioModificar.php" method="post">
                                <!--Creamos botones invisibles para coger el valor de cada entrada por separado y mandarlo al formulario de modificar-->
                                <input type="hidden" name="nombrePelicula" id="nombrePelicula" value="<?php echo $fila['nombrePelicula']; ?>">
                                <input type="hidden" name="calificacion" id="calificacion" value="<?php echo $fila['calificacion']; ?>">
                                <input type="hidden" name="comentario" id="comentario" value="<?php echo $fila['comentario']; ?>">
                                <input type="hidden" name="ID_opinion" id="ID_opinion" value="<?php echo $fila['ID_opinion']; ?>">
                                <input type="submit" value="Modificar" id="botonModificar">
                            </form>

                        <?php
                            echo  "</td> </tr>";
                        } // Fin bucle While - Tabla
                        ?>
                    </table>
                <?php
                    // Cerrar conexión
                    $conexion->close();
                } 
                catch (mysqli_sql_exception $ex) {
                     //Gestión de errores
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