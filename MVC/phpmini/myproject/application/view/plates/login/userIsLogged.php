<?php use App\core\Session; ?>

<?php $this->layout('layout')?>

<div class="container">
    <h2>Login correcto</h2>
    <p>Login perfecto, mi amigo... <?= Session::get("user_name") ?></p>
</div>