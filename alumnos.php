<?php
require 'ConsultasDB.php';

$consultas = new ConsultasDB();
$datos = $consultas->array("SELECT * from alumnos");




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
        <h2 class="title">Alumnos</h2>

        <div style="display: flex;flex-direction: column;">
            <a type="button" class="btn-primary" href="altas_alumnos.php">
                Agregar alumno
            </a>

            <a type="button" class="btn-primary" href="buscar_alumno.php">
                Buscar alumno
            </a>

        </div>

        <?php

        if (sizeof($datos) == 0) {
        ?>
            <div>
                <center>
                    <strong>No se encontraron registros de alumnos</strong>
                </center>
            </div>
        <?php
        } else {
        ?>
            <br><br>
            <table style="margin: 0 auto;">
                <thead>
                    <th>Nombre alumno</th>
                    <th>Folio</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($datos as $item) {
                    ?>
                        <tr>
                            <td><?= $item['nombre_completo'] ?></td>
                            <td><?= $item['folio'] ?></td>
                            <td>

                                <a type="button" href="eliminar_alumno.php?id=<?= $item['id_alumno'] ?>" class="btn-primary">
                                    Eliminar
                                </a>

                                <a style="margin-left: 10px;" href="altas_alumnos.php?id=<?= $item['id_alumno'] ?>" class="btn-primary">
                                    Editar
                                </a>

                                <a style="margin-left: 10px;" href="cursos_alumno.php?id=<?= $item['id_alumno'] ?>" class="btn-primary">
                                    Gestionar cursos del alumno
                                </a>

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
</body>

</html>