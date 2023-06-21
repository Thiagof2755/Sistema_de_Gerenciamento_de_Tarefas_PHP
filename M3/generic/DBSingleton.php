<?php
namespace generic;

use PDO;

class DBSingleton{
    private static $instancia = null;
    private $pdo;
    private $host= "mysql:host=localhost:3306;dbname=tarefasja";
    private $user = "root";
    private $senha = "";

    private function __construct()
    {
        $this->pdo = new PDO($this->host,$this->user,$this->senha);
    }

    public static function getInstance(){
        if(self::$instancia == null){
            self::$instancia=new DBSingleton();
        }
        return self::$instancia;
    }
    private function bind($stmt,$param =array()){
        foreach($param as $k =>$v){
            $stmt->bindValue($k,$v);
        }
    }

    public function executar($sql,$param = array()){
        $stmt = $this->pdo->prepare($sql);
        $this->bind($stmt,$param);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
?>