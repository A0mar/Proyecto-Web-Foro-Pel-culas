<?php
session_start();

// Verificar si la sesión está iniciada
if (isset($_SESSION["ID_usuario"])) {
    $ID_usuario = $_SESSION["ID_usuario"];
    $nombreUsuario = $_SESSION["nombre"];

    // Ahora puedes utilizar $ID_usuario y $nombreUsuario según sea necesario
} else {
    // Si la sesión no está iniciada, redirige al formulario de inicio de sesión
    header("Location:../InicioSesion/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Entrada</title>
    <link rel="stylesheet" href="../css/nuevaEntrada.css">
<body>
<header>
        <h1>Bienvenido a MovieSocial</h1>
    </header>
    <main>
        <section>
            <article>
                <!-- Tabla OPINIONES de la base de datos CINE ("Para acordarnos que tabla se esta utilizando") -->
                <form action="procesarEntrada.php" method="post"> 
                    <label for="nombrePelicula">Nombre de la pelicula</label>
                    <input type="text" name="nombrePelicula" id="nombrePelicula" required>
                    <br>
                    <label for="calificacion">Valoración</label>
                    <input type="number" name="calificacion" id="calificacion" min="1" max="10" required>
                    <br>
                    <label for="comentario">Comentario de la pelicula</label>
                    <textarea name="comentario" id="comentario" cols="20" rows="10"></textarea>
                    <br>
                    <input class="boton" type="submit" value="Subir entrada">
                    <p class="atencion">ATENCIÓN: El uso de lenguaje malsonante u ofensivo puede conllevar la pérdida de su cuenta. Tenga una actitud respetuosa con los demás usuarios</p>
                </form>
            </article>
        </section>
    </main>
    <footer>
        <p class="nombre">Autores: Omar Alonso, Pedro Manuel Merino</p>
        <p class="extra">&copy; <?php echo date("Y"); ?> - MovieSocial </p>
    </footer>
</body>

