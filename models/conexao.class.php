<?php 
    class Conexao{
        private static $conexao = null;
        
        public function __construct(){}

        public static function getInstancia(){
            if(empty(self::$conexao)){
                $param = "mysql:host=localhost;dbname=blog;charset=utf8mb4";

                try{
                    self::$conexao = new PDO($param, "root", "");
                }
                catch (PDOException $e){
                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Problema na conexão";
                    die();
                }
            }

            return self::$conexao;
        }
    }
?>