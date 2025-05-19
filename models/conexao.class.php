<?php 
    class Conexao{
        private static $conexao;
        
        public function __construct(){}

        public static function getInstancia(){
            $param = "mysql:host=localhost;dbname=blog;charset=utf8mb4";

            try{
                self::$conexao = new PDO($param,"root","");
            }
            catch (PDOException $e){
                echo "Problema na conexão";
                die();
            }
        }
    }
?>