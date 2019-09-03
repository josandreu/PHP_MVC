<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
<!--
    <title>--><?php //echo (isset($this->titulo)) ? $this->titulo : 'MINI'?><!--</title>
-->
    <!-- $titulo viene desde TemplatesFactory.php y es común a todas las plantillas
    $titulo tambien puede ser cargado en el controlador correspondiete a cada vista -->
    <title><?php echo $titulo ?></title>
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
<div class="navigation">
    <a href="<?php echo URL; ?>">home</a>
    <a href="<?php echo URL; ?>questions/showQuestions">questions</a>
    <a href="<?php echo URL; ?>questions/insert">Insert</a>
    <a href="<?php echo URL; ?>songs">songs</a>
    <a href="<?php echo URL; ?>canciones">canciones</a>
</div>

<!--
    template code
    AQUÍ ES DONDE CARGARÁ EL CONTENIDO DE CADA VISTA
 -->
<?= $this->section('content') ?>

<!-- backlink to repo on GitHub, and affiliate link to Rackspace if you want to support the project -->
<div class="footer">
    <!--
            Find <a href="https://github.com/panique/mini">MINI on GitHub</a>.
            If you like the project, support it by <a href="http://tracking.rackspace.com/SH1ES">using Rackspace</a> as your hoster [affiliate link].
    -->
</div>

<!-- jQuery, loaded in the recommended protocol-less way -->
<!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
<script>
    const url = "<?php echo URL; ?>";
</script>

<!-- our JavaScript -->
<script src="<?php echo URL; ?>js/application.js"></script>
</body>
</html>