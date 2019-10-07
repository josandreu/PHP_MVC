<?php $this->layout('layout'); ?>

<div class="container">
    <?php if($question): ?>
        <article class="pregunta">
            <h3 class="text-danger"><?= $question->asunto ?></h3>
            <p><?= $question->cuerpo ?></p>
            <h5 class="numAnswers">Número de respuestas: <?= $numberOfAnswers ?></h5>
            <a class="btn btn-outline-dark mt-2" id="showSendAnswers" href="/questions/getAnswersJSON/<?= $question->id_pregunta ?>">Ver respuestas enviadas</a>
            <a class="btn btn-outline-warning mt-2" id="showSendAnswersHandlebars" href="/questions/getAnswersJSONHandlebars/<?= $question->id_pregunta ?>">Ver respuestas enviadas Handlebars</a>
            <a class="btn btn-outline-warning mt-2" id="showSendAnswersHandlebars2" href="/questions/getAnswersJSONHandlebars/<?= $question->id_pregunta ?>">Ver respuestas enviadas Handlebars Dropdown</a>
            <div id="salida" class="salida"></div>
        </article>
    <!-- en el action, mandamos la misma url de la que viene, que contiene el slug de la pregunta, de esta forma no necesitamos colocar inputs hidden -->
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" id="formAnswerJSON" class="mt-3">
            <div class="form-group">
                <label for="answerJSON">Respuesta</label>
                <span><textarea name="answer" class="form-control" id="answerJSON" rows="3"></textarea></span>
            </div>
            <input type="submit" class="btn btn-primary" value="Enviar" />
        </form>
        <div class="mensajef mt-3" id="mensajef"></div>
        <div class="mt-3" id="answerHandleBars1"></div>
        <div class="mt-3" id="answerHandleBars2"></div>
        <h5 class="numAnswersSuccess mt-3"></h5>
    <?php else: ?>
        <p>Pregunta no encontrada</p>
    <?php endif ?>
</div>

<!-- Esto es la plantilla Handlebars que cargaremos cuando pinchemos en el botón, la plantilla recibe el JSON que se manda la vista getAnswersJSONHandlebars -->
<script type="text/x-handlebars-template" id="template">
    <h3>Listado de respuestas</h3>
    <ul class="list-group">
    {{#each answers}}
        <li class="list-group-item"><strong>Id:</strong> {{id_respuesta}} - <strong>Respuesta:</strong> {{respuesta}}</li>
    {{/each}}
    </ul>
</script>

<script type="text/x-handlebars-template" id="templateHandlebars">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Listado de respuestas
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            {{#each answers}}
            <a class="dropdown-item" href="#">{{respuesta}}</a>
            {{/each}}
        </div>
    </div>
</script>