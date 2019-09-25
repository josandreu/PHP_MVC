<?php use App\core\Session;

$this->layout('layout') ?>

<div class="container">
    <h2>Login de usuarios</h2>

    <?php $this->insert('partials/feedback') ?>

    <form action="/login/dologin" method="post" class="login">
        <section>
            <div class="row mt-3">
                <label for="email">Email:</label>
                <input class="form-control" id="email" type="text" name="email">
            </div>
            <div class="row mt-3">
                <label>Clave:</label> <input class="form-control" type="password" name="pass">
            </div>
            <div class="row mt-3">
                <label>Recordarme:</label> <input class="form-control" type="checkbox" name="recordarme" value="1">
            </div>
            <div class="row mt-3">
                <label>&nbsp;</label> <input class="btn btn-danger" type="submit" value="Acceder">
            </div>
        </section>
    </form>
</div>

