<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Omar Alonso">
    <meta name="Author" content="Pedro Merino">
    <link rel="stylesheet" href="">
    <title>Modificar Entrada</title>
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
                
                //Obtener los input del formulario
               $nombrePelicula = $_POST['nombrePelicula'];
               $calificacion = $_POST['calificacion'];
               $comentario = $_POST['comentario'];
               $ID_opinion = $_POST['ID_opinion'];
                
                //Realizar sentencia SQL
                $sentenciaUpdate = $conexion->prepare("UPDATE Opiniones SET nombrePelicula = ?, calificacion = ?, comentario = ? WHERE ID_opinion = ?");
                //Enlazar parámetros
                $sentenciaUpdate->bind_param("sisi",$nombrePelicula,$calificacion,$comentario,$ID_opinion); //s de string, i de int
                //Ejecutar sentencia 
                if ($sentenciaUpdate->execute()) {
                   echo header("Location: misValoraciones.php");
                } else {
                    echo "Error al actualizar la entrada: " . $sentenciaUpdate->error;
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