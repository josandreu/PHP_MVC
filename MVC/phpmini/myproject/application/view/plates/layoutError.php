<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- $titulo viene desde TemplatesFactory.php y es común a todas las plantillas
$titulo_personal se carga en el controlador correspondiete a ca da vista -->
    <title><?php echo (isset($titulo_personal)) ? $titulo_personal : $titulo ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CSS -->
    <link href="<?= URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
<!-- logo -->
<div class="logo">
    MINI
</div>

<!-- navigation -->
<?php $this->insert('partials/menu') ?>

<!--<div class="navigation">
    <a href="<?php /*echo URL; */?>">home</a>
    <a href="<?php /*echo URL; */?>questions/showQuestions">questions</a>
    <a href="<?php /*echo URL; */?>questions/insert">Insert</a>
    <a href="<?php /*echo URL; */?>songs">songs</a>
    <a href="<?php /*echo URL; */?>canciones">canciones</a>
</div>-->


    <div class="container">
        <h1>Página de error</h1>
    </div>
    
    <?= $this->section('content') ?>
</body>
</html>