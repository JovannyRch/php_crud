<?php
require 'ConsultasDB.php';

$consultas = new ConsultasDB();

$id = null;
$data = array();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $consultas->row("SELECT * from alumnos WHERE id_alumno = $id");

    if (isset($_POST['ok'])) {
        $consultas->query("DELETE from alumnos where id_alumno = $id");
        header("Location: alumnos.php");
    }
} else {
    header("Location: alumnos.php");
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
            <li><a class="active"  href="alumnos.php">Gestión alumnos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </div>

    <div class="container">
        <h2 class="title">Eliminar alumno</h2>

        <div>
            <h4>¿Estas seguro de eliminar el alumno <i><b><?= $data['nombre_completo'] ?></b></i> ?</h4>
            <br>
            <a type="button" href="alumnos.php" class="button-agregar">No, cancelar</a>
            <form style="display: inline; margin-left: 10px;" action="./eliminar_alumno.php?id=<?= $id ?>" method="POST">
                <input type="hidden" value="ok" name="ok" />
                <button type="submit" class="btn-primary">Sí, eliminar</button>
            </form>
        </div>

    </div>
</body>

</html>