<?php 
    class postsController{
        private $conexao;

        public function __construct(){
            $this->conexao = Conexao::getInstancia();
        }

        public function listar(){
            $postsDAO = new postsDAO($this->conexao);
            $retorno = $postsDAO->BuscarTodosPosts();

            require_once "views/postsListar.php";
        }
    }
?>