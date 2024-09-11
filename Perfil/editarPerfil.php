<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Omar Alonso">
    <meta name="Author" content="Pedro Merino">
    <link rel="stylesheet" href="../css/editarPerfil.css">
    <title>Editar perfil</title>
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
        <h1>Modificar mis datos</h1>
    </header>
    <main>
        <section>
            <article>

                <?php
                // Conexión a la BD
                try {
                    // Establecer conexión con la BD 
                    $conexion = new mysqli('localhost', 'root', '', 'cine');

                    // Verificar conexión
                    if ($conexion->connect_error) {
                        die("Fallo en la conexión: " . $conexion->connect_error);
                    }

                    // Asociamos la variable de sesión a una variable normal
                    $ID_usuario = $_SESSION["ID_usuario"];

                    // Sentencia SQL
                    $sentenciaSelect = $conexion->prepare("SELECT nombre, correo, telefono, contrasena FROM Usuarios WHERE ID_usuario = ?");

                    // Enlazar parámetros
                    $sentenciaSelect->bind_param("s", $ID_usuario);

                    // Ejecutar consulta
                    $sentenciaSelect->execute();

                    // Obtener resultado
                    $resultado = $sentenciaSelect->get_result();

                    $fila = $resultado->fetch_assoc();
                    echo "<h1 id=datosAntiguos>DATOS ANTIGUOS</h1>";
                    echo "Nombre: " . $fila["nombre"] . "<br>";
                    echo "Correo: " . $fila["correo"] . "<br>";
                    echo "Teléfono: " . $fila["telefono"] . "<br>";
                    $contrasena = $fila["contrasena"];
                ?>
                <br><br>
                    <form action="procesarEditar.php" method="post">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Introduzca nuevo nombre" value="<?php echo $fila['nombre']; ?>">
                        <br>

                        <label for="correo">Correo electrónico:</label>
                        <input type="text" name="correo" id="correo" placeholder="Introduzca nuevo correo" value="<?php echo $fila['correo']; ?>">
                        <br>

                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" placeholder="Introduzca nuevo teléfono" value="<?php echo $fila['telefono']; ?>">
                        <br>
                        
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" name="contrasena" id="contrasena" placeholder="Introduzca nueva contraseña" value="<?php echo $fila['contrasena'];?>">
                        <br>
                        <br>
                        <input type="submit" value="Modificar datos">
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
    </footer></body>

</html>