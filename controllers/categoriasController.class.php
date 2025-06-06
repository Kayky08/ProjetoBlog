<?php 
    class categoriasController{
        private $conexao;

        //Criando a Conexão com o banco de dados
        public function __construct(){
            $this->conexao = Conexao::getInstancia();
        }

        public function listar(){
            //Buscando todas as Categorias e exibindo
            $categoriasDAO = new categoriasDAO($this->conexao);
            $retorno = $categoriasDAO->BuscarTodasCategorias();

            require_once "views/categoriasListar.php";
        }

        public function inserir(){
            $msg = "";
            $erro = false;

            //Verificando se recebeu os dados via Post
            if($_POST){
                //Verificando se os campos não estão vazios
                if(empty($_POST['descritivo'])){
                    $erro = true;
                    $msg = "Preencha o descritivo";
                }

                if(!$erro){
                    //Criando a nova categoria e inserindo no banco de dados
                    $categoria = new Categorias(cdescritivo:$_POST['descritivo']);
                    $categoriasDAO = new categoriasDAO($this->conexao);
                    $categoriasDAO->inserir($categoria);

                    //Redirecionando para a lista de categorias
                    header("location:/ProjetoBlog/listarCategorias");
                    die();
                }
            }

            require_once "views/categoriasInserir.php";
        }

        public function alterar(){
            $msg = "";
            $erro = false;

            //Pegando os dados recebidos via $_GET e buscando a categoria referente ao id da categoria
            if(isset($_GET)){
                $categoria = new Categorias(id_categorias:$_GET['id']);
                $categoriasDAO = new categoriasDAO($this->conexao);
                $retorno = $categoriasDAO->BuscarUmaCategoria($categoria);
            }

            //Verificando se recebeu os dados via Post
            if($_POST){
                //Verificando se os campos não estão vazios
                if(empty($_POST['descritivo'])){
                    $erro = true;
                    $msg = "Preencha o descritivo";
                }

                if(!$erro){
                    //Alterando a categoria e atualizando no banco de dados
                    $categoria = new Categorias(id_categorias:$_POST['id_categorias'],cdescritivo:$_POST['descritivo']);
                    $categoriasDAO = new categoriasDAO($this->conexao);
                    $categoriasDAO->alterar($categoria);

                    //Redirecionando para a lista de categorias
                    header("location:/ProjetoBlog/listarCategorias");
                    die();
                }
            }

            require_once "views/categoriasAlterar.php";
        }

        public function deletar(){
            //Pegando os dados recebidos via $_GET e buscando a categoria referente ao id da categoria
            if(isset($_GET)){
                $categoria = new Categorias(id_categorias:$_GET['id']);
                $categoriasDAO = new categoriasDAO($this->conexao);
                $categoriasDAO->deletar($categoria);

                //Redirecionando para a lista de categorias
                header("location:/ProjetoBlog/listarCategorias");
                die();
            }
        }
    }
?>