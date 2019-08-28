<?php
include_once 'connection.php';

///////////////////////////////
/// Conexión a la BBDD
///////////////////////////////

$conn = Connection::conn([PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$name = null;
$id = null;
if (isset($_POST['name'])) {
  $name = $_POST['name'];
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

$select = $conn->prepare("SELECT * FROM persona WHERE nombre = ?");
$select->bindParam(1, $name);
$select->execute();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-danger">Introduce nombre o id para buscar en la tabla</h3>
        <form action="02_form_pdo.php" method="post" class="mt-4">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="First name" name="name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="id" name="id">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
    <div class="container mt-5">
        <pre>
            <?php
                while ($row = $select->fetch()) {
                    foreach ($row as $index => $item) {
                        echo 'columna: '.$index.' - valor: '.$item, PHP_EOL;
                    }
                }
            ?>
        </pre>
    </div>
    <div class="container mt-5">
        <pre>
            <?php

            ?>
        </pre>
    </div>
</body>
</html>
