<?php


abstract  class DBPDO
{
    private const HOST = 'localhost';

    private $dbName = 'pdoexample';
    private $pass = 'lomu4229';
    private $user = 'root';

    private $lastQuery = false; // si estamos en modeDEV = true, nos indica la ultima operacion con la tabla

    private $persistent = true; // PDO::ATTR_PERSISTENT

    public $modeDEV = true; // nos inventamos una variable para indicar si estamos en modo desarrollo
    public $errors = false;
    public $db;

    /**
     * DBPDO constructor.
     */
    public function __construct() {
        $this->db = $this->Connection();
    }

    public function getConnection() {
        return $this->db;
    }

    function Connection() {
        $dsn = 'mysql:host='.self::HOST.';dbname='.$this->dbName;
        $options = array(PDO::ATTR_PERSISTENT => $this->persistent,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $conn = new PDO($dsn, $this->user, $this->pass, $options);
            //echo 'Conexión OK';
        } catch(PDOException $exception) {
            $this->errors = $exception->getMessage();
            // si estamos en modo dev... que nos muestre los errores
            if ($this->modeDEV == true) {
              print_r($this->errors);
            }
            return false;
        }
        return $conn;
    }

    public function setDBPass(string $pass) {
        $this->pass = $pass;
        $this->Connection(); // para que vuelva a conectar con el nuevo pass
    }

    public function setDBUser(string $user) {
        $this->user = $user;
        $this->Connection();
    }

    /* Cambia toda la configuración de golpe
       COMO INVOCAR ESTA FUNCIÓN
         $db->setDB(array(
                 "dbName"   => 'nombreBD',
                 "pass"     => 'pass',
                 "user"     => 'user'));
     */
    public function setDB(array $data) {
        $this->dbName = $data['dbName'];
        $this->pass = $data['pass'];
        $this->user = $data['user'];
        $this->Connection();
    }

    public function lastQuery() {
        return $this->lastQuery;
    }

    public function setLastQuery($sql) {
        if ($this->modeDEV == true) {
            $sql->debugDumpParams();
        }
    }


    /**
     * @param int $limit
     * @return array
     * Devuelve un objeto con tod0 el contenido de la tabla
     */
    public function getAll(int $limit = 10) {
        // this->table se refiere a la propiedad de las clases que van a heredar esta clase
        // esto es posible porque este método existe en la clase que hereda de ésta
        // tambien podríamos pasarlo como parametro y darle valor en cada clase que herede de esta
        $prepare = $this->db->prepare("SELECT * FROM {$this->table} LIMIT {$limit}");
        $prepare->execute();
        $this->setLastQuery($prepare);
        return $prepare->fetchAll(PDO::FETCH_ASSOC); // nos devolverá toda la info de la tabla como un obejto
    }

    public function insert(array $params) {
        if (!empty($params)) {
            // validación de los parámetros sin hacer, debería de hacerse en el modelo
            $fields = '('.implode(',', array_keys($params)).')'; // junta en un string (implode) separando cada elemento con una coma, las keys del array asociativo (array_keys)
            $values = "('".implode("', '", array_values($params))."')"; // lo mismo pero con los values
            $prepare = $this->db->prepare('INSERT INTO '.$this->table.' '.$fields.' VALUES '.$values);
            $prepare->execute();
            $this->setLastQuery($prepare);
            return $this->db->lastInsertId();
        } else {
            throw new Exception('Los parámetros están vacíos');
        }
    }

    /**
     * @param array $params
     * @return bool
     * Realiza lo mismo que la anterior, pero parametrizada, es decir, que comprueba los datos
     * y previene código inyectado.
     * Devuelve el id de la fila insertada
     *
     * $params = array("id" => '3', "nombre" => 'Pepe', "email" => 'test@test.com', "password" => md5('12345'));
     * $id = $usuario1->insert2($params);
     */
    public function insert_(array $params) {
        $fields = "(".implode(',', array_keys($params)).")"; // convertimos a string las columnas ('columna', :value)
        $values = array();
        foreach (array_keys($params) as $value) {
            $val = ':'.$value; // añadimos ':' a cada key para luego usarlas en los bindValue
            $values[] = $val; // guardamos en un array cada una de las keys que pasaremos como parametro
        }
        $stringValues = '('.implode(',', $values).')'; // convertimos a string los valores ('columna', :value)
        $prepare = $this->db->prepare('INSERT INTO '.$this->table.' '.$fields.' VALUES '.$stringValues) ;
        foreach ($params as $key => $value) {
            // añadimos al prepare por cada key => value que pasemos como parametro
            $prepare->bindValue($key, $value);
        }
        $prepare->execute();
        $this->setLastQuery($prepare);
        return $this->db->lastInsertId();
    }

    // igual que insert_() pero en menos líneas
    public function insert_2(array $params) {
        $fields = implode(',', array_keys($params));
        $values = ':'.implode(',:', array_keys($params));
        $prepare = $this->db->prepare("INSERT INTO $this->table ($fields) VALUES ($values)");
        $prepare->execute($this->normalizePrepareArray($params));
        $this->setLastQuery($prepare);
        echo $this->db->lastInsertId();
    }

    // versión mejorada de update_2
    public function update(array $sets, array $params) {
        if (!empty($sets)) {
          $fields = '';
            foreach ($sets as $key => $value) {
                $fields .= $key.' = :'.$key.','; // 'nombre = :nombre, edad = :edad...,'
          }
            $fields = rtrim($fields, ','); // eliminamos la coma de la derecha
            $key = key($params); // obtenemos la key del WHERE
            $value = $params[key($params)]; // obtenemos el value del WHERE
            $prepare = $this->db->prepare("UPDATE ".$this->table." SET $fields WHERE $key = '$value'");
            /*foreach ($sets as $key => $value) {
                $prepare->bindValue($key, $value);
                echo $key.' : '.$value, PHP_EOL;
            }
            $prepare->execute();*/
            $prepare->execute($this->normalizePrepareArray($sets));
            $this->setLastQuery($prepare);
        }
    }

    public function update_2(array $sets, array $params) {
        if (!empty($sets)) {
          if (count($sets) == 1) {
              // UPDATE usuarios SET nombre = 'Pene' WHERE id = 4;
              $prepare = $this->db->prepare("UPDATE {$this->table} SET ".array_keys($sets)[0]." = ".array_values($sets)[0]." WHERE ".array_keys($params)[0]." = ".array_values($params)[0]);
              $this->setLastQuery($prepare);
              $prepare->execute();
          } else {
              // UPDATE usuarios SET nombre = :nombre, edad = :edad WHERE id = 4;
              $arraySets = array(); // 'nombre, :nombre, edad, :edad...'
              foreach (array_keys($sets) as $array_key) {
                $key = ':'.$array_key;
                $arraySets[] = $array_key;
                $arraySets[] = $key;
              }
              $stringSet = ''; // en esta variable guardaremos el string 'nombre = :nombre, edad = :edad...'
              for ($i = 0; $i < count($arraySets); $i+=2) {
                  $stringSet .= $arraySets[$i].' = '.$arraySets[$i + 1];
                  // añadimos una coma, siempre y cuando no sea el último parámetro
                  if ($i < count($arraySets) - 2) {
                      $stringSet .= ', ';
                  }
              }
              print_r($stringSet);
              echo PHP_EOL;
              $prepare = $this->db->prepare("UPDATE ".$this->table." SET {$stringSet} WHERE ".array_keys($params)[0].' = '.array_values($params)[0]);
              foreach ($sets as $key => $value) {
                  $prepare->bindValue($key, $value);
                  echo $key.' : '.$value, PHP_EOL;
              }
              $prepare->execute();
              $this->setLastQuery($prepare);
          }
        }
    }

    public function delete(array $params) {
        // DELETE from usuarios WHERE id = 4
        $key = key($params);
        $value = $params[key($params)];
        $prepare = $this->db->prepare("DELETE FROM $this->table WHERE $key = $value");
        $prepare->execute();
        $this->setLastQuery($prepare);
    }

    /**
     * @param array $params
     * @return array
     * Normalizamos el array y le añadimos los : delante de la key ejemplo nombre = :nombre
     *
     * Convierte esto
    [id] => 4
    [nombre] => Pepe
    [email] => pepe@test.com
    [password] => 827ccb0eea8a706c4c34a16891f84e7b
     *
     * En esto
    [:id] => 4
    [:nombre] => Pepe
    [:email] => pepe@test.com
    [:password] => 827ccb0eea8a706c4c34a16891f84e7b
     */
    private function normalizePrepareArray(array $params) {
        foreach ($params as $key => $value) {
            $params[':'.$key] = $value;
            unset($params[$key]); // elimina del array resultante las posiciones originales(sin los ':'), sino tambien las devolvería
        }
        return $params;
    }
}