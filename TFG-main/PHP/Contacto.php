<?php
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $fecha = $_POST["fecha"];
        $id_coche = $_POST["Id_coche"];
        $asunto = $_POST["mensaje"];

        // Datos de conexión a la base de datos
        $servername = "localhost"; // Cambiar si es necesario
        $username = "root"; // Cambiar por tu nombre de usuario
        $password = ""; // Cambiar por tu contraseña
        $dbname = "TuCocheIdeal"; // Cambiar si es necesario

        // Crear conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error en la conexión: " . $conn->connect_error);
        }

        // Preparar la consulta SQL para insertar los datos en la tabla Cita
        $stmt = $conn->prepare("INSERT INTO Cita (nombre_cliente, correo_electronico, telefono, fecha, Id_coche, asunto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $nombre, $correo, $telefono, $fecha, $id_coche, $asunto);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo '<script>alert("Cita registrada exitosamente.");</script>';
        } else {
            echo '<script>alert("Error al registrar la cita: ' . $stmt->error . '");</script>';
        }   
        // Cerrar la conexión a la base de datos
        $stmt->close();
        $conn->close();
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/Index.css">
    <link rel="stylesheet" href="../CSS/Footer.css">
    <link rel="icon" href="../Imagenes/Logo.png">
    <title>Tu Coche Ideal</title>
</head>
<body>
<header>
    <a href="../HTML/Index.html"><img class="Logo" src="../Imagenes/Logo.png"></a>
    <nav id="menu">
        <a class="menu" href="../HTML/Index.html">Inicio <img src="../Imagenes/icono%20casa.png"></a>
        <a class="menu" href="../PHP/Coches.php">Coches <img src="../Imagenes/icono%20coche.png"></a>
        <a class="menu" href="../PHP/Contacto.php">Contacto <img src="../Imagenes/icono%20telefono.png"></a>
        <a class="menu" href="../HTML/Financiacion.html">Financiación <img src="../Imagenes/icono%20euro.png"></a>
    </nav>
</header>
<br>
<div class="div_prin_contacto">
    <h1>Contáctanos</h1>
    <hr>
    <form class="cita" method="post">
        <h3>Reserva tu cita</h3>
        <hr>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <hr>
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <br>
        <hr>
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" maxlength="9">
        <br>
        <hr>
        <label for="fecha">Fecha:</label>
        <input type="datetime-local" id="fecha" name="fecha" required>
        <br>
        <hr>
        <label for="Id_coche">Id del coche</label>
        <input type="number" id="Id_coche" name="Id_coche" required>
        <br>
        <hr>
        <label for="mensaje">Asunto de la cita:</label>
        <textarea id="mensaje" name="mensaje"></textarea>
        <br>
        <hr>
        <button id="borrar" type="reset">Borrar</button>
        <button id="enviar" type="submit">Enviar</button>
    </form>

    <br>
    <hr>
    <br>
    <iframe id="ubicacon" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3092.4411792735696!2d-0.4870156846819415!3d39.18742297952696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd61afcb9db1b2d9%3A0x8519f209c76d71f6!2sTu%20Coche%20Ideal!5e0!3m2!1ses!2ses!4v1643362164706!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<br>
<footer>
    <div class="footer">
        <div class="row">
            <ul>
              <li><a href="Contacto.php">Contacta con Nosotros</a></li>
              <li><a href="Coches.php">Nuestros servicios</a></li>
              <li><a href="../HTML/Index.html">Quienes Somos</a></li>
              <li><a href="../HTML/Contacto.html">¿Donde Estamos?</a></li>
            </ul>
        </div>
        <div class="row">
            TuCocheIdeal Copyright © 2021 TCI - All rights reserved ||
            Designed By: Javier Ruiperez Huerta        </div>
    </div>
</footer>
</body>
</html>