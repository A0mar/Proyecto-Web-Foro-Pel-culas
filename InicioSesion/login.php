<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Pedro Merino">
    <meta name="Author" content="Omar Alonso">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>
    <header>
        <h1>Bienvenido a MovieSocial</h1>
    </header>
    <main>
        <section>
            <article>
                <?php
                session_start();

                // Verificar si el usuario ya está autenticado
                if (isset($_SESSION["nombre"])) {
                    header("Location: ../index.php"); //Redireccionar a la página principal
                    exit();
                }
                // Mostrar el formulario de inicio de sesión si no está autenticado
                ?>
                <form action="validarLogin.php" method="post">
                    <label for="nombre">Usuario</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Introduzca nombre de usuario" required>
                    <br>
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" placeholder="Introduca contraseña" required>
                    <br>
                    <input class="boton" type="submit" value="Iniciar Sesion">
                </form>
                <br>
                <form action="registrar.php" method="post">
                    <input class="boton" type="submit" value="Registrarse">
                </form>
                <a class="enlace" href="usuarioModerador.php">¿Eres un usuario moderador? Pincha aquí</a>
            </article>
        </section>
    </main>
    <footer>
        <p class="nombre">Autores: Omar Alonso, Pedro Manuel Merino</p>
        <p class="extra">&copy; <?php echo date("Y"); ?> - MovieSocial </p>
    </footer>
</body>

</html>