<?php
include_once 'connection.php';

///////////////////////////////
/// Conexión a la BBDD
///////////////////////////////

$conn = Connection::conn([PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

print_r(PDO::getAvailableDrivers());


// Podemos pasar las opciones en el constructor o con setAttribute()
// $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// ATRIBUTOS DE LA CONEXIÓN
print_r($conn->getAttribute(PDO::ATTR_SERVER_INFO));
echo "</br>";
print_r($conn->getAttribute(PDO::ATTR_CONNECTION_STATUS));
echo "</br>";
print_r($conn->getAttribute(PDO::ATTR_SERVER_VERSION));
echo "</br>";
print_r($conn->getAttribute(PDO::ATTR_CLIENT_VERSION));

$attributes = array(
    "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
    "ORACLE_NULLS", "PERSISTENT", "SERVER_INFO", "SERVER_VERSION"
);

foreach ($attributes as $val) {
    echo "PDO::ATTR_$val: ";
    echo $conn->getAttribute(constant("PDO::ATTR_$val")) . "<br>";
}

///////////////////////////////
/// ejemplos con QUERY
///////////////////////////////

// INSERT
// $conn->query("INSERT INTO persona (nombre, nacimiento) VALUES ('Topo', '1990-01-01')");
// echo 'ID insertado: '.$conn->lastInsertId();

// SELECT
$selectQuery = $conn->query('SELECT * FROM persona');
$selectQuery2 = $conn->query('SELECT * FROM persona');
$selectQuery3 = $conn->query('SELECT * FROM persona');

// callback function PDO::FETCH_FUNC
function showRows($id, $value) {
    echo "id = $id | value = $value", PHP_EOL;
}

///////////////////////////////
/// ejemplos con PREPARE
///////////////////////////////

/*
 * bindParam()
 * Si hacemos el enlace $q->bindParam($value) asociamos el
parámetro o variable, el valor puede cambiar antes de hacer el
execute()
 * bindValue()
 * Si hacemos el enlace $q->bindValue($value) asociamos el valor de
la variable a prepare, el valor NO puede cambiar ya porque esta evaluado
 */

// INSERT
$insertPrepare = $conn->prepare("INSERT INTO persona (nombre, nacimiento) VALUES (:name, :fnac)");
$name = 'Mini pene';
$fnac = '1900-02-02';
// bindValue enlaza el valor de la variable, el valor NO puede cambiar ya porque esta evaluado
$insertPrepare->bindValue(':name', $name, PDO::PARAM_STR);
// asociamos el parámetro o variable, el valor puede cambiar antes de hacer execute()
$insertPrepare->bindParam(':fnac', $fnac, PDO::PARAM_STR);
//$insertPrepare->execute();
//echo $insertPrepare->rowCount();

// SELECT con :id
$selectPrepare = $conn->prepare("SELECT * FROM persona WHERE id = :id");
$id = 1;
$selectPrepare->bindParam(':id', $id);
$selectPrepare->execute();
// SELECT con ?
$selectPrepare2 = $conn->prepare("SELECT * FROM persona WHERE id = ?");
$selectPrepare2->bindParam(1, $id);
$selectPrepare2->execute();
// SELECT con ? + execute(array)
$selectPrepare3 = $conn->prepare("SELECT * FROM persona WHERE id = ? and nombre = ?");
$selectPrepare3->execute(array('1', 'Pedro'));
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h3>FetchAll</h3>
        <pre>
            <?php
                print_r($selectQuery->fetchAll());
            ?>
        </pre>
    </div>
    <div class="container">
        <div class="mt-5">
            <h3>Fetch (while + row)</h3>
            <pre>
                <?php
                    while ($row = $selectQuery2->fetch()) {
                        print_r($row);
                    }
                ?>
            </pre>
        </div>
        <div class="mt-5">
            <h3>FetchAll + callback</h3>
            <pre>
                <?php
                    $result = $selectQuery3->fetchAll(PDO::FETCH_FUNC, 'showRows');
                ?>
            </pre>
        </div>
        <div class="mt-5">
            <h3>Select + prepare() 1</h3>
            <pre>
                <?php
                    print_r($selectPrepare->fetchAll());
                ?>
            </pre>
        </div>
        <div class="mt-5">
            <h3>Select + prepare() 2</h3>
            <pre>
                <?php
                    print_r($selectPrepare2->fetchAll());
                ?>
            </pre>
        </div>
        <div class="mt-5">
            <h3>Select + prepare() 3</h3>
            <pre>
                <?php
                    print_r($selectPrepare3->fetchAll());
                ?>
            </pre>
        </div>
    </div>
</body>
</html>

