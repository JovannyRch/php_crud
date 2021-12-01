<?php


require 'ConsultasDB.php';

$consultas = new ConsultasDB();



$id = -1;
$data = array('nombre_completo' => '');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $consultas->row("SELECT * from alumnos WHERE id_alumno = $id");
}

if (isset($_POST['inscripcion'])) {
    $id_socio = $_POST['inscripcion'];
    $consultas->query("INSERT INTO alumnos_cursos(id_socio, id_alumno) values($id_socio, $id)");
    unset($_POST);
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=$id");
    exit;
}

if (isset($_POST['eliminacion'])) {
    $id_socio = $_POST['eliminacion'];
    $consultas->query("DELETE FROM alumnos_cursos where id_socio = $id_socio and id_alumno = $id");
    unset($_POST);
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=$id");
    exit;
}



$cursos_disponibles = $consultas->array("SELECT socios.* from socios where id_socio not in 
(SELECT ac.id_socio from alumnos_cursos ac where ac.id_alumno = $id)");

$cursos_inscritos = $consultas->array("SELECT socios.* from socios where id_socio in 
(SELECT ac.id_socio from alumnos_cursos ac where ac.id_alumno = $id)");

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
        <h2 class="title">Gestión cursos del alumno:</h2>
        <h3 style="text-align: center;"><?= $data['nombre_completo'] ?></h3>

        <div class="row">
            <div style="width: 50%;padding: 10px;">

                <h4>Cursos inscritos</h4>

                <?php
                if (sizeof($cursos_inscritos) == 0) {
                ?>
                    <div>
                        <center>
                            <i>Al alumno no está inscrito en ningun curso</i>
                        </center>
                    </div>
                <?php
                } else {
                ?>
                    <br><br>
                    <table>

                        <tbody>
                            <?php
                            foreach ($cursos_inscritos as $item) {
                            ?>
                                <tr>
                                    <td><?= $item['servicio'] ?></td>
                                    <td>

                                        <form method="POST" action="cursos_alumno.php?id=<?= $id ?>">
                                            <input type="hidden" value="<?= $item['id_socio'] ?>" name="eliminacion">
                                            <button type="submit" href="cursos_alumnos.php" class="btn-primary">
                                                Eliminar inscripción
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>

            </div>

            <div style="width: 50%; padding: 10px;">
                <h4>Cursos disponibles</h4>

                <?php
                if (sizeof($cursos_disponibles) == 0) {
                ?>
                    <div>
                        <center>
                            <i>Al alumno no tiene cursos disponibles</i>
                        </center>
                    </div>
                <?php
                } else {
                ?>
                    <br><br>
                    <table>

                        <tbody>
                            <?php
                            foreach ($cursos_disponibles as $item) {
                            ?>
                                <tr>
                                    <td><?= $item['servicio'] ?></td>
                                    <td>

                                        <form method="POST" action="cursos_alumno.php?id=<?= $id ?>">
                                            <input type="hidden" value="<?= $item['id_socio'] ?>" name="inscripcion">
                                            <button type="submit" href="cursos_alumnos.php" class="btn-primary">
                                                Inscribir
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>