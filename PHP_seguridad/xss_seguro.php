<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-3">
        <h2>Formulario</h2>
        <form method="post" action="xss_seguro.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="comment">Comentario</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <input type="submit" value="Enviar" class="btn btn-outline-success">
        </form>
        <p class="mt-2">
            <?php
                // primero comprobamos que existan
                if(isset($_POST['email']) && isset($_POST['comment'])) {
                    $email = $_POST['email'];
                    // saneamos el email (eliminamos caracteres no deseados)
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    // validamos email
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)) echo 'Email válido<br>';
                    else echo 'Email no válido<br>';
                    // lo mismo, pero con el operador ternario
                    echo filter_var($email, FILTER_VALIDATE_EMAIL) ? 'Válido<br>' : 'No válido<br>';
                    // eliminamos espacios iniciales y finales
                    $comment = trim($_POST['comment']);
                    if(empty($comment)) echo 'Comentario vacío<br>';
                    else {
                        // eliminamos etiquetas html (para evitar inyeccion de código)
                        $comment = strip_tags($comment);
                        // sustituye los símbolos html, escapa los caracteres html (se usa por ejemplo en XML)
                        $comment = htmlspecialchars($comment);
                        // guardamos en un fichero de texto el contenido del textarea
                        file_put_contents('comments.txt', $comment, FILE_APPEND);
                    }
                    echo $comment;
                } else echo 'No se ha definido alguno de los input';
            ?>
        </p>
    </div>
</body>
</html>

