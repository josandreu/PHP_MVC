<?php
$formName = $_POST['name'];
$formAge = $_POST['age'];
sleep(2);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-3">
        <p>El nombre es <?= $formName ?> y tiene <?= $formAge ?> años</p>
    </div>
</body>
</html>
