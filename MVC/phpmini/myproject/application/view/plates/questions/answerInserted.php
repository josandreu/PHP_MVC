
<div class="container">
    <?php if ($answer) : ?>
        <div class="alert alert-success">
            <p>La pregunta con id <?= $answer ?> se ha insertado correctamente</p>
        </div>
    <?php else: ?>
        <?php $this->insert('partials/feedback'); ?>
    <?php endif ?>
</div>
