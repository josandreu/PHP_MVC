<?= $this->layout('layout')?>
<div class="container">
<!--    --><?php //$this->renderFeedbackMessages() ?>
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
                </footer>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


