<?php


require 'ConsultasDB.php';

$consultas = new ConsultasDB();


$id = null;
$esModificacion = false;
$data = array(
    "id_socio" => null,
    "institucion" => "",
    "estado" => "",
    "servicio" => "",
);
$mensaje = "";


if (isset($_GET['id'])) {
    $esModificacion = true;
    $id = $_GET['id'];
    $data = $consultas->row("SELECT * from socios WHERE id_socio = $id");
}



$mensaje = '';
if (isset($_POST['institucion']) && isset($_POST['estado']) && isset($_POST['servicio'])) {



    $institucion = $_POST['institucion'];
    $estado = $_POST['estado'];
    $servicio = $_POST['servicio'];

    $data = array(
        "id_socio" => null,
        "institucion" => $institucion,
        "estado" => $estado,
        "servicio" => $servicio
    );

    if (!$esModificacion) {
        $res = $consultas->query("INSERT INTO socios(institucion, estado, servicio) values('$institucion', '$estado', '$servicio')");

        $mensaje = "Socio registrado exitosamente";
    } else {
        $consultas->query("UPDATE socios SET 
        institucion = '$institucion',
        estado = '$estado',
        servicio = '$servicio'
        where id_socio = $id");
        $mensaje = "Socio actualizado exitosamente";
    }

    
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
            <li><a class="active" href="socios.php">Gestión socios</a></li>
            <li><a href="alumnos.php">Gestión alumnos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </div>

    <div class="container">
        <h2 class="title">
        <?= $esModificacion ? 'Modificación' : 'Alta' ?> socios</h2>

        <form action="altas_socios.php<?= $esModificacion ? "?id=$id" : "" ?>" class="form" method="POST">
            <label for="institucion">Institución a la que pertencen</label>
            <input required type="text" value="<?= $data['institucion'] ?>"  name="institucion">
            <br>
            <label for="estado">Estado o región</label>
            <input required type="text" value="<?= $data['estado'] ?>"  name="estado">
            <br>
            <label for="estado">Servicio</label>
            <input required type="text" value="<?= $data['servicio'] ?>"  name="servicio">

            <button type="submit" class="btn-primary">
                <?= $esModificacion ? 'Modificar' : 'Registrar' ?>
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