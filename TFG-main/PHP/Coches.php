<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TuCocheIdeal";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Función para actualizar el estado de reserva en la base de datos
function reservarCoche($cocheId) {
  global $conn;
  $sql = "UPDATE coche SET reservado = 'Reservado' WHERE id = $cocheId";
  if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Coche reservado exitosamente, rellene el formulario de contacto para acudir a por su coche.");
      window.location.href = "Contacto.php";
      </script>';
  } else {
      echo '<script>alert("Error al reservar coche, puede que el coche ya haya sido reservado.");</script>' . $conn->error;
  }
}

// Verificar si se ha enviado el formulario de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cocheId"])) {
  $cocheId = $_POST["cocheId"];
  reservarCoche($cocheId);
}

// Realizar la consulta SQL para seleccionar los coches
$sql = "SELECT * FROM coche LIMIT 3";
$result = $conn->query($sql);
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
<div class="container">
  <h1>Coches</h1>
  <br>
  <?php
    // Iterar sobre los resultados y mostrar la información de cada coche
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="image-container-coches">';
            echo '<img src="../Imagenes/Captura de pantalla 2023-05-18 192501.png" alt="Imagen">';
            echo '<div class="text-container">';
            echo '<h3>' . $row["nombre"] . '</h3>';
            echo '<p>Precio: ' . $row["precio"] .'€'. '</p>';
            if ($row["reservado"] == 'Reservado') {
              echo '<p>Estado: Reservado</p>';
          } else {
              echo '<form method="post">';
              echo '<input type="hidden" name="cocheId" value="' . $row["id"] . '">';
              echo '<button id="reservar" type="submit">Reservar</button>';
              echo '</form>';
          }
          echo '</div>';
          echo '</div>';
      }
        }else{
        echo "No se encontraron coches en la base de datos.";
    }
    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>  
</div>  
<br>
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
          Designed By: Javier Ruiperez Huerta
        </div>
    </div>
</footer>
</body>
</html>