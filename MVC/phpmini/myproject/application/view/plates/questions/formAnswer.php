<?php $this->layout('layout'); ?>

<div class="container">
    <?php if($question): ?>
        <article class="pregunta">
            <h3 class="text-danger"><?= $question->asunto ?></h3>
            <p><?= $question->cuerpo ?></p>
        </article>
    <!-- en el action, mandamos la misma url de la que viene, que contiene el slug de la pregunta, de esta forma no necesitamos colocar inputs hidden -->
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" id="formAnswer">
            <div class="form-group">
                <label for="answer">Respuesta</label>
                <span><textarea name="answer" class="form-control" id="answer" rows="3"></textarea></span>
            </div>
            <input type="submit" class="btn btn-primary" value="Enviar" />
            <div class="mensajef"></div>
        </form>
    <?php else: ?>
        <p>Pregunta no encontrada</p>
    <?php endif ?>
</div>



