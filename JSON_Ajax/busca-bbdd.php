<?php
$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'ejemplo');
define('DB_USER', 'root');
define('DB_PASS', 'lomu4229');
define('DB_CHARSET', 'utf8');
$conn = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
$query = $conn->prepare("SELECT * FROM song WHERE artist LIKE :term");
$query->bindValue(':term', "%" . $_GET['term'] . '%', PDO::PARAM_STR);
$query->execute();

//saco la respuesta y la muestro con json
$res = $query->fetchAll();
echo json_encode($res);