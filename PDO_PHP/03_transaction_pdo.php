<?php
include_once 'connection.php';

///////////////////////////////
/// Conexión a la BBDD
///////////////////////////////
$opciones = array(	PDO::ATTR_PERSISTENT 	=> true, //Conexion persistente
                    PDO::ATTR_ERRMODE		=> PDO::ERRMODE_EXCEPTION); //Lanzar excepciones

$conn = Connection::conn();

/*
 * https://www.php.net/manual/es/mysqli.quickstart.stored-procedures.php
 * Una vez tenemos el objeto PDO
Sea de golpe o por etapas, se garantiza que se aplicaran los
cambios a la base de datos de forma segura y sin interferencia de
otras conexiones una vez realizamos el ‘commit’
 * El trabajo puede ser deshecho automáticamente bajo petición
 * Lotes de operaciones a la vez con prepare, query o exec
 * Debemos abrir la conexión con PDO::beginTransaction
 * Podemos usar metodos como PDO:commit() y PDO::rollBack()
 * Desactiva el modo autocommit
 */

try {

//=========================
//! MODO TRANSACTIONAL
//=========================

//Inicio de transaction
$conn->beginTransaction();


//Hacemos query a usuario y obtenemos los valores de las columnas
$re = $conn->query('SELECT * FROM persona');

// imprimimos los datos de cada columna de la tabla
print_r($re->getColumnMeta(0));
echo "</br>";
print_r($re->getColumnMeta(1));
echo "</br>";
print_r($re->getColumnMeta(2));
echo "</br>";

//Declaramos el array a insertar
$nombres = array('Carlos','Luis','Juan','Maria');

$consultas = array();

$query_template = $conn->prepare("INSERT INTO persona (nombre) VALUE (:name)");

foreach($nombres as $key => $value) {

    // vamos asignando a cada una de las posiciones del array la template
    $consultas[$key] = $query_template;

    //Enlazamos la variable value, si esta cambia antes del commit se cambia el resultado
    $consultas[$key]->bindParam(':name',$value);

    //Enlazamos el valor, si luego cambia el valor de value, este ya no cambiara
    //$consultas[$key]->bindValue(':name',$value);

    //Otra opcion en vez de bindparam es pasarle los datos en un array numero o clave valor
    //$consulta->execute($datos);

    //Ejecutamos la query, no se ejecuta hasta hacer el commit
    $consultas[$key]->execute();

}

    //Lanzamos las consultas
    $conn->commit();

    //Obtener atributos de la bd
    echo $conn->getAttribute(PDO::ATTR_SERVER_VERSION);
    echo "</br>";
    echo $conn->getAttribute(PDO::ATTR_SERVER_INFO);
    echo "</br>";

    //=========================
    //! MODO NO TRANSACTIONAL
    //=========================


    $consultas = $conn->query("INSERT INTO persona (nombre) VALUE ('Carlos')");

    //Ultimo ID insertado
    echo $conn->lastInsertId();
    echo "</br>";

    //Hacemos una query
    $consulta = $conn->query("SELECT * FROM persona");

    $res = $consulta->fetchAll(PDO::FETCH_ASSOC); //Todos los objetos en modo objeto

    print_r($res);
    echo "</br>";

} catch(PDOException $evento) {

    //Control de errores

    echo '<br/>'.$evento->getMessage();
    echo "</br>";
    die();

}
?>
