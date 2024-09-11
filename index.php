<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página pricipal de MovieSocial</title>
  <meta name="Author" content="Pedro Merino">
  <meta name="Author" content="Omar Alonso">
  <link rel="stylesheet" href="css/index.css">
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
    <!-- Imágen de la empresa-->
    <!--   <img src="img/iconoEmpresa.jpg" alt="Icono de la empresa"> -->

    <!-- Buscador -->
    <form action="buscar.php" method="post">
      <input type="hidden" name="nombre" value="<?php echo $fila['nombre']?>">
      <input type="text" name="nombre" id="nombre" placeholder="Buscar una película">
      <input type="submit" value="Buscar">
    </form>

    <div class="dropdown">
      <h2 class="bienvenido"> Bienvenido <?php echo $_SESSION["nombre"]; ?></h2>

      <div class="dropdown-content">
        <ul class="limpiarpunto">

          <a href="Perfil/miPerfil.php" class="usuarioperfil">Mi perfil</a>
          <a href="InicioSesion/logout.php" class="usuarioperfil">Cerrar sesion</a>
        </ul>
      </div>
    </div>

    <!-- FONDO PÁGINA PRINCIPAL-->
    <h1 class="fondofoto">MOVIESOCIAL</h1>

    <nav>
      <div class="derecha">
        <a href="valoraciones/nuevaEntrada.php">Nueva entrada</a>
        <a href="foro.php">Foro de discusión</a>
        <a href="valoraciones/misValoraciones.php">Ver mis entradas</a>
      </div>
    </nav>
  </header>


  <main>
    <section>
      <article>
        <div class="centro">
          <h1>Películas premiadas</h1>
          <!--Tabla que muestra las peliculas premiadas-->
          <table class="reddit-table">
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha de Estreno</th>
            <th>Premios Obtenidos</th>
            <th>Género</th>


            <?php
            //Conexión a la BD
            try {
              //Establecer conexion con la BD 
              $conexion = new mysqli('localhost', 'administradorOmar', 'Clave_00', 'cine');

              // Verificar conexión
              if ($conexion->connect_error) {
                die("Fallo en la conexión: " . $conexion->connect_error);
              }
              //Creamos la sentencia
              $senteciaSelect = $conexion->prepare("SELECT * FROM Peliculas WHERE premios >= 1 ORDER BY premios DESC");
              $senteciaSelect->execute();
              $resultado = $senteciaSelect->get_result();

              //Creamos una tabla para mostrar los resultados
              while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                  <td>" . $fila['nombre'] .  "</td> 
                  <td>" . $fila['descripcion'] .  "</td> 
                  <td>" . $fila['fecha_estreno'] .  "</td> 
                  <td>" . $fila['premios'] .  "</td>
                  <td>" . $fila['genero'] .  "</td>
                  </tr>";
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
          </table>
        </div>
      </article>
    </section>



    <section>
    </section>
  </main>


  <footer>
        <p class="nombre">Autores: Omar Alonso, Pedro Manuel Merino</p>
        <p class="extra">&copy; <?php echo date("Y"); ?> - MovieSocial </p>
    </footer>
</body>

</html>