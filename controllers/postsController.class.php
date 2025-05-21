<?php
    date_default_timezone_set("America/Sao_Paulo");

    class postsController{
        private $conexao;

        public function __construct(){
            $this->conexao = Conexao::getInstancia();
        }

        public function listar(){
            $postsDAO = new postsDAO($this->conexao);
            $retorno = $postsDAO->BuscarTodosPosts();

            $tagsDAO = new tagsDAO($this->conexao);
            $retorno2 = $tagsDAO->BuscarTodasTags();

            require_once "views/postsListar.php";
        }

        public function inserir(){
            $msg = ["","",""];
            $erro = false;

            if($_POST){
                if(empty($_POST['titulo'])){
                    $erro = true;
                    $msg[0] = "Preencha o Titulo.";
                }
                if(empty($_POST['conteudo'])){
                    $erro = true;
                    $msg[1] = "Preencha o Conteudo.";
                }
                if(empty($_POST['tag'])){
                    $erro = true;
                    $msg[2] = "Preencha a Tag.";
                }

                if(!$erro){
                    $tagsInseridas=[];
                    $tagsNomes = explode(',', $_POST['tags']);

                    $tagDAO= new tagsDAO($this->conexao);

                    foreach($tagsNomes as $nomes){
                        
                    }

                    $post = new Posts(titulo:$_POST['titulo'],conteudo:$_POST['conteudo'],datap: date("Y-m-d H:i:s"));
                    $postsDAO = new postsDAO($this->conexao);
                    $retorno = $postsDAO->inserir($post);

                    //header("location:/ProjetoBlog/inserir");
                    //die();
                }
            }
            
            require_once "views/postsInserir.php";
        }
    }
?>