<?= $this->layout('layoutError') ?> <!-- layout es la ruta del archivo a renderizar, en este caso layout.php en la raiz de /plates -->
<div class="container">
    <p>This is the Error-page. Will be shown when a page (= controller / method) does not exist.</p>
    <p><?= $msg ?></p>
</div>
<?php d($msg) ?>
