<?php

include_once 'enlace.php';
include_once 'select.php';
include_once 'select_default.php';
include_once 'select_multiple.php';

$enlace1 = new Enlace('www.google.es', 'Google');
$enlace2 = new Enlace('www.google.es', 'Google');

//$select = '';
//if (isset($_GET['select'])) {
//    $select = $_GET['select'];
//}

$mySelect1 = new Select('select1', ["rojo" => 'red', "azul" => 'blue']);

$mySelect2 = new SelectDefault('select2', ["1" => 'uno', "2" => 'dos', "3" => 'tres'], '3');
// $mySelect2->markAsDefault('2');

$mySelect3 = new SelectMultiple('select3', ["1" => 'uno', "2" => 'dos', "3" => 'tres'], '3', true);

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Ejercicio 1, generar links</h2>
        <div class="row mt-3 text-center">
            <div class="col-6">
                <?php
                echo $enlace1->imprimeLink();
                ?>
            </div>
            <div class="col-6">
                <?php
                $enlace1->imprimeLink2();
                ?>
            </div>
            <div class="mt-3">
                <form action="index.php" method="get">
                    <select name="select" id="select">
                        <option value="1">Opción 1</option>
                        <option value="2">Opción 2</option>
                        <option value="3">Opción 3</option>
                        <option value="4">Opción 4</option>
                    </select>
                    <input class="btn btn-outline-danger" type="submit" value="Enviar">
                </form>
            </div>
        </div>
        <div class="mt-5">
            <?php $mySelect1->write(); ?>
        </div>
        <div class="mt-5">
            <?php $mySelect2->write('select2'); ?>
        </div>
        <div class="mt-5">
            <?php $mySelect3->write('select3', 'style = "font-size:140%; color:red" '); ?>
        </div>
    </div>
</body>
</html>
