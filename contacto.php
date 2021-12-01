<?php


require 'ConsultasDB.php';

$consultas = new ConsultasDB();
$mensaje = "";
if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['mensaje'])) {
    
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    $consultas->query("INSERT INTO mensajes(nombre,correo,telefono,mensaje) values('$nombre', '$correo', '$telefono', '$mensaje')");
    $mensaje = "¡Gracias por comunicarse con nosotros!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Circulo de Acciones de Quintana Roo </title>
    <link rel="stylesheet" href="styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />

</head>

<body>

    <div class="navbar">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="socios.php">Gestión socios</a></li>
            <li><a href="alumnos.php">Gestión alumnos</a></li>
            <li><a class="active" href="contacto.php">Contacto</a></li>
        </ul>
    </div>

    <div class="container">
        <h2 class="title">Contacto</h2>
        <form action="contacto.php" class="form" method="POST">
            <label for="nombre">Nombre completo</label>
            <input required type="text" name="nombre">
            <br>

            <label for="correo">Correo</label>
            <input required type="email" name="correo">
            <br>

            <label for="telefono">Teléfono</label>
            <input type="text" required name="telefono">
            <br>


            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" cols="40" rows="3"></textarea>
            <br>

            <button type="submit" class="btn-primary">
                Enviar
            </button>
        </form>

        <?php
        if ($mensaje != "") { ?>
            <br>
            <br />
            <center>
                <div class="message-container">
                    <strong>
                        <?= $mensaje ?>
                    </strong>
                </div>
            </center>
        <?php } ?>
    </div>
</body>

</html>