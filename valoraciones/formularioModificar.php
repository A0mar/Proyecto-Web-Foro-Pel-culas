<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Omar Alonso">
    <meta name="Author" content="Pedro Merino">
    <link rel="stylesheet" href="../css/nuevaEntrada.css">
    <title>Formulario para modificar las entradas</title>
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
        <h1>Formulario para modificar la entrada</h1>
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

                    //Obtener el id del formulario 
                    $ID_opinion = $_POST['ID_opinion'];
                    $nombrePelicula = $_POST['nombrePelicula'];
                    $calificacion = $_POST['calificacion'];
                    $comentario = $_POST['comentario'];
                   
                    
                    //Sentencia SQL
                    $sentenciaSelect = $conexion->prepare("SELECT ID_opinion, calificacion, comentario,nombrePelicula FROM Opiniones WHERE ID_opinion = ?");
                    //Enlazar parámetros
                    $sentenciaSelect->bind_param("i",$ID_opinion);
                    //Ejecutar consulta
                    $sentenciaSelect->execute();
                    //Obtener los resultados
                    $sentenciaSelect->bind_result($ID_opinion,$calificacion,$comentario,$nombrePelicula);
                    //Obtener el valor
                    $sentenciaSelect->fetch();
                ?>
                    <form action="modificarEntrada.php" method="post">
                        <label for="nombrePelicula">Nombre de la película:</label>
                        <input type="text" name="nombrePelicula" id="nombrePelicula" value="<?php echo $nombrePelicula; ?>">
                        <br>

                        <label for="calificacion">Calificacion:</label>
                        <input type="number" min="1" max="10" name="calificacion" id="calificacion" value="<?php echo $calificacion; ?>">
                        <br>

                        <label for="comentario">Comentario:</label>
                        <textarea name="comentario" id="comentario" cols="30" rows="10"><?php echo $comentario;?></textarea>
                        <br>
                        <input type="hidden" name="ID_opinion" id="ID_opinion" value="<?php echo $ID_opinion ?>">
                        <input type="submit" value="Modificar entrada">
                    </form>
                <?php
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