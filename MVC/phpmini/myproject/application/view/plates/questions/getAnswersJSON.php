<?php if ($answers) : ?>
    <?php
    $res = array(
        'success' => true,
        'answers' => $answers
    )
    ?>
<?php else: ?>
    <?php
    $res = array(
        'success' => false,
        'msg' => $this->fetch('partials/feedback') // fetch nos lo guarda en el índice del array 'msg'
    )
    ?>
<?php endif ?>
<?= json_encode($res) ?>
