-- Crear la base de datos TuCocheIdeal
CREATE DATABASE IF NOT EXISTS TuCocheIdeal;

-- Seleccionar la base de datos TuCocheIdeal
USE TuCocheIdeal;

-- Crear la tabla Coche
CREATE TABLE IF NOT EXISTS Coche (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    reservado VARCHAR(9)
);

-- Crear la tabla Cita
CREATE TABLE IF NOT EXISTS Cita (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    fecha DATE NOT NULL,
    id_coche INT(6) UNSIGNED,
    asunto VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_coche) REFERENCES Coche(id)
);

INSERT INTO Coche (nombre, precio) VALUES
    ('BMW (ID:1)', 10000.00),
    ('BMW (ID:2)', 15000.00),
    ('BMW (ID:3)', 20000.00);