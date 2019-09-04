<?= $this->layout('layout')?>

<div class="container">
    <!-- MOSTRAREMOS UN BLOQUE U OTRO DEPENDIENDO DE LA ACCIÓN QUE MANDA EL CONTROLADOR Questions.php -->
    <?php if (isset($accion) && $accion == 'editar') : ?>
        <h3>Editar pregunta</h3>
        <article class="jumbotron text-center">
            <h4>Datos actuales de la pregunta</h4>
            <?php if (isset($_GET['slug'])) :?>
            <p>slug: <?= $_GET['slug'] ?></p>
            <?php endif; ?>
            <?php foreach ($resultAsArray as $data) : ?>
            <p>Asunto: <?= $data->asunto ?></p>
            <p>Cuerpo: <?= $data->cuerpo ?></p>
            <?php endforeach; ?>
        </article>
    <?php else : ?>
        <h3>Que quieres saber?</h3>
        <p class="font-weight-bold">Dinos cual es tu pregunta</p>
    <?php endif ?>
    
    <!-- 
    En 1ª instancia, para poder mostrar la plantilla feedback.php y además borrar las variables de sesión
    había creado renderFeedbackMessages() en Templates.php, pero lo más sencillo es incluir la plantilla por un lado
    y registrar en TemplatesFactory.php la funcion delete_msg_feedback() que borra las variables de sesión y que incluiremos
    en la plantilla feedback.php
     -->
    <?php /*$this->renderFeedbackMessages() */?>
    
    <?= $this->insert('partials/feedback') ?>

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
                <input type="text" name="asunto" class="form-control" value="<?= isset($dato['asunto']) ? $dato['asunto'] : " " ?>">
            </div>
            <div class="row mt-2">
                <label for="cuerpo">Cuerpo</label>
                <input type="text" name="cuerpo" class="form-control" value="<?= isset($dato['cuerpo']) ? $dato['cuerpo'] : " " ?>">
            </div>
            <div class="row mt-3">
                <input type="submit" value="Enviar" class="btn btn-outline-dark">
            </div>
        </form>
    </div>
</div>
