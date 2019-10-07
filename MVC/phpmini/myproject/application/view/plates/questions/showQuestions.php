<?= $this->layout('layout')?>
<div class="container">
    <?= $this->insert('partials/feedback') ?>
    <h2>Todas las preguntas</h2>
    <?php if (count($questions) == 0) : ?>
        <h4>No se encuentran preguntas en la base de datos</h4>
    <?php else : ?>
        <p>Tenemos <?= count($questions)?> preguntas en la bbdd</p>
        <?php foreach ($questions as $question) : ?>
            <article class="jumbotron">
                <h4><?= $question->asunto ?></h4>
                <p><?= $question->cuerpo ?></p>
                <footer>
                    <a href="/questions/edit/<?= $question->slug ?>?slugURL=<?= $question->slug ?>">[Editar]</a>
                    <!-- pasamos el id de la pregunta para saber cuantas respuesta tiene esa pregunta, este enlace tendrá comportamiento AJAX, que programaremos desde application.js, nos traemos la vista howManyAnswers por AJAX  -->
                    <a class="link-how-many" href="/questions/howManyAnswers/<?= $question->id_pregunta ?>">[Cuantas respuestas<span></span>]</a>
                    <a href="/questions/sendAnswer/<?= $question->slug ?>">[ Responder (Ajax básico) ]</a>
                    <a href="/questions/sendAnswerJSON/<?= $question->slug ?>">[ Responder JSON + Ajax ]</a>
                </footer>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


