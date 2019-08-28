<?php
include_once 'model/UsuarioModel.php';
$usuario1 = new Usuario();

echo '<pre>';
print_r($usuario1->getAll(1));

$params = array("id" => '4', "nombre" => 'Pepe', "email" => 'pepe@test.com', "password" => md5('12345'));
//$id = $usuario1->insert2('usuarios', $params);
//print_r($usuario1->lastQuery());

//$usuario1->insert_2(array("id" => 5, "nombre" => 'Solomillo', "email" => 'solomillo@pop.com', "edad" => 69));
/*try {
    $usuario1->insert();
} catch(Exception $exception) {
    echo 'Error '.$exception->getMessage();
}*/

$usuario1->delete(["id" => 5]);