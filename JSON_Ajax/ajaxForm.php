<?php

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
    <script>
        $(function () {
            // cuando se ejecute el evento submit...
            $('#myForm').on('submit', function (e) {
                e.preventDefault(); // para que no envie el formulario por POST
                // AJAX ---> $.post() ---> load data form the server using HTTP POST request
                // $.post(URL, parametros, funcion(datos, estado, xhr), tipoDato)
                // se solicita el contenido de la url dataFormAjax.php, le decimos que muestre el contenido de esta página dentro del párrado 'messagge' con los parámetros del formulario serializados (como si los mandáramos desde el formulario por POST a través del navegador)
                $.post('dataFormAjax.php', $('#myForm').serialize(), function (data) {
                    $('#message').html(data);
                });
            });
        });
    </script>
</head>
<body>
<div class="container mt-5">
    <form method="post" action="dataFormAjax.php" id="myForm">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" id="name"  placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="age">Edad</label>
            <input type="text" name="age" class="form-control" id="age" placeholder="Edad">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <p id="message"></p>
</div>
</body>
</html>
