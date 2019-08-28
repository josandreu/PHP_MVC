<div class="container">
    <!-- MOSTRAREMOS UN BLOQUE U OTRO DEPENDIENDO DE LA ACCIÓN QUE MANDA EL CONTROLADOR Questions.php -->
    <?php if (isset($this->accion) && $this->accion == 'editar') : ?>
        <h3>Editar pregunta</h3>
        <article class="jumbotron text-center">
            <h4>Datos actuales de la pregunta</h4>
            <?php if (isset($_GET['slug'])) :?>
            <p>slug: <?= $_GET['slug'] ?></p>
            <?php endif; ?>
            <?php foreach ($this->resultAsArray as $data) : ?>
            <p>Asunto: <?= $data->asunto ?></p>
            <p>Cuerpo: <?= $data->cuerpo ?></p>
            <?php endforeach; ?>
        </article>
    <?php else: ?>
        <h3>Que quieres saber?</h3>
        <p class="font-weight-bold">Dinos cual es tu pregunta</p>
    <?php endif ?>

<!--
<?php /*if (isset($this->errores) && count($this->errores) > 0) : */?>
        <div class="bg-danger p-3 mb-2 rounded">
            <ul class="mb-0">
                <?php /*foreach ($this->errores as $error) : */?>
                    <li class="text-light"><?/*= $error */?></li>
                <?php /*endforeach; */?>
            </ul>
        </div>

    <?php /*endif */?>
-->

    <?php $this->renderFeedbackMessages() ?>

    <div class="container-fluid">
        <!-- $_SERVER['REQUEST_URI'] = /questions/insert -->
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="row">
                <label for="asunto">Asunto</label>
                <!--
                value -> existe $data['issue'] ????
                        si existe, lo mostramos
                        y sino, no mostramos nada -> " "
                 esto solo se muestra si se manipula el nombre de alguno de los campos del formulario, proviene del array que se pasa
                 a la vista en el caso de que -> if (!isset($_POST['issue']) || !isset($_POST['body']))
                 -->
                <input type="text" name="asunto" class="form-control" value="<?= isset($this->data['asunto']) ? $this->data['asunto'] : " " ?>">
            </div>
            <div class="row mt-2">
                <label for="cuerpo">Cuerpo</label>
                <input type="text" name="cuerpo" class="form-control" value="<?= isset($this->data['cuerpo']) ? $this->data['cuerpo'] : " " ?>">
            </div>
            <div class="row mt-3">
                <input type="submit" value="Enviar" class="btn btn-outline-dark">
            </div>
        </form>
    </div>
</div>
<?php d($this->data) ?>
