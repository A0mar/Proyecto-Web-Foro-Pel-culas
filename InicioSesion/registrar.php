<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Pedro Merino">
    <meta name="Author" content="Omar Alonso">
    <link rel="stylesheet" href="../css/registrar.css">
    <title>Registrar Usuario</title>
</head>
<body>
    <header>Página de registro</header>
    <main>
        <section>
            <article>
                <form action="altaUsuario.php" method="post">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required placeholder="Introduce un nombre de usuario">
                    <br>
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{10,}$" minlength="10" placeholder="Introduce Contraseña">
                    <br>
                    <label for="correo">Correo Eléctronico:</label>
                    <input type="email" name="correo" id="correo" required pattern=".*@.*" placeholder="Introduce un correo eléctronico"> 
                    <br>
                    <label for="telefono">Telefono:</label>
                    <input type="tel" name="telefono" id="telefono" placeholder="Introduce un número de teléfono (Opcional)">
                    <br>
                    <input class="boton" type="submit" value="Registrarme">
                </form>
            </article>
        </section>
    </main>
    <footer>
        <p class="nombre">Autores: Omar Alonso, Pedro Manuel Merino</p>
        <p class="extra">&copy; <?php echo date("Y"); ?> - MovieSocial </p>
    </footer>
</body>
</html>