<div class="container">
<!--    <h3>Editar pregunta</h3>
    <article class="jumbotron">
        <h4>Datos actuales de la pregunta</h4>
        <?php /*if (isset($_GET['slug'])) :*/?>
            <p>slug: <?/*= $_GET['slug'] */?></p>
        <?php /*endif; */?>
        <?php /*foreach ($this->resultAsArray as $data) : */?>
            <p>Asunto: <?/*= $data->asunto */?></p>
            <p>Cuerpo: <?/*= $data->cuerpo */?></p>
        <?php /*endforeach; */?>
    </article>

    <?php /*if (isset($this->errores) && count($this->errores) > 0) : */?>
        <div class="bg-danger p-3 mb-2 rounded">
            <ul class="mb-0">
                <?php /*foreach ($this->errores as $error) : */?>
                    <li class="text-light"><?/*= $error */?></li>
                <?php /*endforeach; */?>
            </ul>
        </div>
    <?php /*endif */?>

    <div class="container-fluid">
        <form action="<?/*= $_SERVER['REQUEST_URI'] */?>" method="post">
            <div class="row">
                <label for="issue">Asunto</label>
                <input type="text" name="issue" class="form-control" value="<?/*= $this->resultAsObject['asunto'] */?>">
            </div>
            <div class="row mt-2">
                <label for="body">Cuerpo</label>
                <input type="text" name="body" class="form-control" value="<?/*= $this->resultAsObject['cuerpo'] */?>">
            </div>
            <div class="row mt-3">
                <input type="submit" value="Enviar" class="btn btn-outline-dark">
            </div>
        </form>
    </div>-->

    <h3>Gracias por editar la pregunta!</h3>

</div>
