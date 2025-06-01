<?php 
    class categoriasController{
        private $conexao;

        public function __construct(){
            $this->conexao = Conexao::getInstancia();
        }

        public function listar(){
            $categoriasDAO = new categoriasDAO($this->conexao);
            $retorno = $categoriasDAO->BuscarTodasCategorias();

            require_once "views/categoriasListar.php";
        }

        public function inserir(){
            $msg = "";
            $erro = false;

            if($_POST){
                if(empty($_POST['descritivo'])){
                    $erro = true;
                    $msg = "Preencha o descritivo";
                }

                if(!$erro){
                    $categoria = new Categorias(cdescritivo:$_POST['descritivo']);
                    $categoriasDAO = new categoriasDAO($this->conexao);
                    $categoriasDAO->inserir($categoria);

                    header("location:/ProjetoBlog/listarCategorias");
                    die();
                }
            }

            require_once "views/categoriasInserir.php";
        }

        public function alterar(){
            $msg = "";
            $erro = false;

            if(isset($_GET)){
                $categoria = new Categorias(id_categorias:$_GET['id']);
                $categoriasDAO = new categoriasDAO($this->conexao);
                $retorno = $categoriasDAO->BuscarUmaCategoria($categoria);
            }

            if($_POST){
                if(empty($_POST['descritivo'])){
                    $erro = true;
                    $msg = "Preencha o descritivo";
                }

                if(!$erro){
                    $categoria = new Categorias(id_categorias:$_POST['id_categorias'],cdescritivo:$_POST['descritivo']);
                    $categoriasDAO = new categoriasDAO($this->conexao);
                    $categoriasDAO->alterar($categoria);

                    header("location:/ProjetoBlog/listarCategorias");
                    die();
                }
            }

            require_once "views/categoriasAlterar.php";
        }

        public function deletar(){
            if(isset($_GET)){
                $categoria = new Categorias(id_categorias:$_GET['id']);
                $categoriasDAO = new categoriasDAO($this->conexao);
                $categoriasDAO->deletar($categoria);

                header("location:/ProjetoBlog/listarCategorias");
                die();
            }
        }
    }
?>