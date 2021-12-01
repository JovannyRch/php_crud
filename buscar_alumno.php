<?php
require 'ConsultasDB.php';

$consultas = new ConsultasDB();

$result = null;
$query = "";
$cursos = array();
if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $result = $consultas->row("SELECT * from alumnos where nombre_completo LIKE '%$query%' or folio LIKE '%$query%'");
    $cursos = array();
    if ($result != null) {
        $id_alumno = $result['id_alumno'];
        $cursos = $consultas->array("SELECT socios.* from socios where id_socio in 
        (SELECT ac.id_socio from alumnos_cursos ac where ac.id_alumno = $id_alumno)");
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
        <h2 class="title">Buscar alumno</h2>

        <div style="width: 450px;">
            <form action="buscar_alumno.php" method="POST">
                <label for="query">Ingrese folio o nombre del alumno</label>
                <input value="<?= $query ?>" required type="text" name="query">
                <br>
                <button type="submit" class="btn-primary">Buscar</button>
            </form>
        </div>

        <?php
        if (strlen($query) != 0) {

            if ($result == null) {
        ?>
                <center>
                    <b>No se encontraron resultados</b>
                </center>
            <?php
            } else {
            ?>
                <br>
                <br>
                <h3>Nombre del alumno: <i><?= $result['nombre_completo'] ?></i></h3>
                <h3>Folio: <i><?= $result['folio'] ?></i></h3>

                <?php
                if (sizeof($cursos) == 0) {
                ?>
                    <div>
                        <center>
                            <i>Al alumno no está inscrito en ningun curso</i>
                        </center>
                    </div>
                <?php
                } else {
                ?>  
                    <br>
                    <h4>Cursos inscritos: </h4>
                    <table>

                        <tbody>
                            <?php
                            foreach ($cursos as $item) {
                            ?>
                                <tr>
                                    <td><?= $item['servicio'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>

        <?php
            }
        }
        ?>

    </div>
</body>

</html>