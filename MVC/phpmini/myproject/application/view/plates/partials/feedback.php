<?php use App\core\Session;

?>

<?php if (!is_null(Session::get('feedback_negative')) && count(Session::get('feedback_negative')) > 0) : ?>
    <div class="error-feedback">
        <div class="bg-danger p-3 mb-2 rounded">
            <ul class="mb-0">
                <?php foreach (Session::get('feedback_negative') as $error) : ?>
                    <li class="text-light"><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif ?>

<?php if (!is_null(Session::get('feedback_positive')) && count(Session::get('feedback_positive')) > 0) : ?>
    <div class="bg-success p-3 mb-2 rounded">
        <ul class="mb-0">
            <?php foreach (Session::get('feedback_positive') as $exito) : ?>
                <li class="text-light"><?= $exito ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif ?>

<!-- para borrar las variables de sesión -->
<?php $this->delete_msg_feedback() ?>