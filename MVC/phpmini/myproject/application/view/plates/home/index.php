<?= $this->layout('layout') ?>

<div class="container">
    <h3>You are in the View: application/view/home/index.php (everything in the box comes from this file)</h3>
    <p>In a real application this could be the homepage.</p>
    <?php $this->insert('partials/banner') ?> <!-- INSERTAMOS LA VISTA partial/banner.php -->
</div>

<?php d($titulo) ?>