<div class="container">
    <div class="jumbotron">
        <div class="container-fluid">
            <!-- La variable canción nos viene del controlador canciones.php, dentro del método ver() -->
            <?php d($this->cancion); ?>
            <h2><?= $this->cancion->track ?></h2>
            <p><strong>Artista:</strong> <?= $this->cancion->artist ?></p>
            <p><strong>URL:</strong> <a href="<?=$this->cancion->link?>"><?=$this->cancion->link?></a></p>
            <p class="mt-4"><a href="/canciones/listar">Volver al listado</a></p>
        </div>
    </div>
</div>
