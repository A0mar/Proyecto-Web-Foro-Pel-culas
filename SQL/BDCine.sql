/* Autores:
Omar Alonso y Pedro Merino
*/

DROP DATABASE IF EXISTS cine;
CREATE DATABASE cine;
USE cine;

-- Tabla Usuarios
CREATE TABLE Usuarios (
    ID_usuario int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NOT NULL,
    contrasena varchar(255) NOT NULL,
    correo varchar(255) NOT NULL,
    telefono int(9)
);

-- Tabla Peliculas
CREATE TABLE Peliculas (
    ID_pelicula int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NOT NULL,
    descripcion varchar(500) NOT NULL,
    fecha_estreno date,
    premios int,
    genero varchar(255) NOT NULL
);

-- Tabla Opiniones
CREATE TABLE Opiniones (
    ID_opinion int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    ID_usuario int,
    calificacion int,
    comentario varchar(1000),
    fecha_opinion date,
    nombrePelicula varchar(50),
    FOREIGN KEY (ID_usuario) REFERENCES Usuarios(ID_usuario),
    FOREIGN KEY (ID_pelicula) REFERENCES Peliculas(ID_pelicula)
);

-- Tabla Moderador 
CREATE TABLE Moderadores (
    ID_moderador INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (correo),
);


-- Para la tabla Peliculas
INSERT INTO Peliculas (nombre, descripcion, fecha_estreno, premios, genero) VALUES
('El Padrino: Parte II', 'La continuación de la historia de la familia Corleone, explorando la juventud de Vito Corleone y el ascenso de su hijo Michael.', '1974-12-20', 6, 'Drama'),
('La lista de Schindler', 'La historia real de Oskar Schindler, un empresario alemán que salva la vida de más de mil judíos durante el Holocausto.', '1993-12-15', 7, 'Drama'),
('Antorcha Humana: La leyenda de Ron Burgundy', 'Las desventuras de Ron Burgundy, un presentador de noticias egocéntrico en los años 70.', '2004-07-09', 1, 'Comedia'),
('El Gran Hotel de Budapest', 'Un conserje y su joven aprendiz se ven involucrados en una trama de robo y asesinato en un elegante hotel europeo.', '2014-02-06', 4, 'Comedia'),
('El juego de Ender', 'En un futuro donde niños son entrenados para liderar en una guerra interestelar, Ender Wiggin destaca como estratega brillante.', '2013-10-24', 0, 'CienciaFiccion'),
('Interstellar', 'Un grupo de astronautas viaja a través de un agujero de gusano en busca de un nuevo hogar para la humanidad.', '2014-10-26', 1, 'CienciaFiccion'),
('The Notebook', 'La historia de amor entre Noah y Allie, que se conocen en la juventud y enfrentan desafíos a lo largo de sus vidas.', '2004-06-25', 0, 'Romance'),
('Pride and Prejudice', 'La relación entre Elizabeth Bennet y Mr. Darcy en la Inglaterra del siglo XIX.', '2005-11-10', 1, 'Romance'),
('The Shining', 'Un escritor y su familia se mudan a un hotel aislado durante el invierno, donde sucede lo paranormal.', '1980-05-23', 2, 'Terror'),
('Get Out', 'Un hombre afroamericano descubre eventos perturbadores cuando visita la casa de la familia de su novia blanca.', '2017-02-24', 4, 'Terror'),
('Toy Story', 'Los juguetes de un niño cobran vida cuando él no está presente y experimentan una aventura cuando un nuevo juguete se une al grupo.', '1995-11-22', 4, 'Animacion'),
('Frozen', 'La princesa Anna emprende un viaje para encontrar a su hermana Elsa, cuyos poderes han sumido al reino en un invierno eterno.', '2013-11-19', 2, 'Animacion'),
('Indiana Jones: En busca del arca perdida', 'El arqueólogo Indiana Jones se embarca en una misión para encontrar el Arca de la Alianza antes que los nazis.', '1981-06-12', 5, 'Aventura'),
('El libro de la Jungla', 'Mowgli, un niño criado por lobos, se embarca en una aventura en la selva acompañado por animales amigos.', '2016-04-04', 1, 'Aventura');
