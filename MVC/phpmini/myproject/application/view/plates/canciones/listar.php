<?= $this->layout('layout') ?>
<div class="container">
    <!--
    this->canciones es una propiedad del objeto vista que se crea al utilizar el método render() de View.php
    el método render() es llamado desde el controlador canciones.php, método listar()

    * AL INTEGRAR plates, pasamos de $this->canciones a $canciones
     -->
    <?php foreach($canciones as $cancion): ?>
        <article class="jumbotron jumbotron-fluid" >
            <div class="container-fluid">
                <header class="font-weight-bold"><a href="ver/<?=$cancion->id?>"><?= $cancion->track ?></a></header>
                <p><strong>Artista:</strong> <?= $cancion->artist ?></p>
            </div>
        </article>
    <?php endforeach; ?>
</div>