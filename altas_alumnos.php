<?php


require 'ConsultasDB.php';

$consultas = new ConsultasDB();


$id = null;
$esModificacion = false;
$data = array(
    "nombre_completo" => null,
    "folio" => "",
);
$mensaje = "";

if (isset($_GET['id'])) {
    $esModificacion = true;
    $id = $_GET['id'];
    $data = $consultas->row("SELECT * from alumnos WHERE id_alumno = $id");
}



if (isset($_POST['nombre_completo']) && isset($_POST['folio'])) {

    $nombre_completo = $_POST['nombre_completo'];
    $folio = $_POST['folio'];

    $data = array(
        "id_alumno" => null,
        "nombre_completo" => $nombre_completo,
        "folio" => $folio
    );


    if (!$esModificacion) {
        $res = $consultas->query("INSERT INTO alumnos(nombre_completo, folio) values('$nombre_completo', '$folio')");
        $mensaje = "Alumno registrado exitosamente";
    } else {
        $sql = "UPDATE alumnos SET 
        nombre_completo = '$nombre_completo',
        folio = '$folio'
        where id_alumno = $id";
        $consultas->query($sql);
        $mensaje = "Alumno actualizado exitosamente";
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
            <li><a href="socios.php">Gestión socios</a></li>
            <li><a class="active" href="alumnos.php">Gestión alumnos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </div>
    <div class="container">
        <h2 class="title">
            <?= $esModificacion ? 'Modificación' : 'Alta' ?> alumnos</h2>

        <form action="altas_alumnos.php<?= $esModificacion ? "?id=$id" : "" ?>" class="form" method="POST">
            <label for="nombre_completo">Nombre completo del alumno</label>
            <input required type="text" value="<?= $data['nombre_completo'] ?>" name="nombre_completo">
            <br>
            <label for="folio">Folio del alumno</label>
            <input required type="text" value="<?= $data['folio'] ?>" name="folio">
            <br>
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