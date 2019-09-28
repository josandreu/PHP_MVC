<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <style type="text/css">
        body{
            background-color: #eee;
        }
        #cargando{
            border: 1px solid #66e;
            padding: 10px;
            background-color: #ccf;
            width: 300px;
            margin-top: 150px;
            position: absolute;
            display:none;
        }
        #capamensaje{
            margin-top: 30px;
            border: 1px solid #6e6;
            padding: 10px;
            background-color: #cfc;
        }
    </style>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        $(function() {
            $('#mienlace').on('click', function(e) {
                e.preventDefault(); // evitamos el comportamiento por defecto
                $('#capamensaje').load('contenido.php');
            });
            // cuando se inicie una conexión ajax aparecerá la capa cargando con un efecto
            $(document).ajaxStart(function() {
                $('#cargando').slideDown(1000);
            });
            // ahora al contrario
            $(document).ajaxStop(function() {
                $('#cargando').slideUp(1000);
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <a href="contenido.php" id="mienlace">Enlace Ajax</a>

        <div id="capamensaje">

        </div>

        <div id="cargando">
            <p class="p-2">cargando...</p>
        </div>
    </div>
</body>
</html>
