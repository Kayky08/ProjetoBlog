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

            foreach ($retorno as $linha) {
                $id = $linha->id_posts;

                if (!isset($postsAgrupados[$id])) {
                    $postsAgrupados[$id] = [
                        'id' => $linha->id_posts,
                        'titulo' => $linha->titulo,
                        'datap' => $linha->datap,
                        'conteudo' => $linha->conteudo,
                        'usuario' => $linha->nome,
                        'tags' => []
                    ];
                }

                $postsAgrupados[$id]['tags'][] = $linha->descritivo;
            }

            require_once "views/postsListar.php";
        }

        public function inserir(){
            $msg = ["","",""];
            $erro = false;

            if(!isset($_SESSION)) session_start();

            if($_POST){
                if(empty($_POST['titulo'])){
                    $erro = true;
                    $msg[0] = "Preencha o Titulo.";
                }
                if(empty($_POST['conteudo'])){
                    $erro = true;
                    $msg[1] = "Preencha o Conteudo.";
                }
                if(empty($_POST['tags'])){
                    $erro = true;
                    $msg[2] = "Preencha pelo menos uma Tag.";
                }

                if(!$erro){
                    $usuario = new Usuarios(id_usuarios: $_SESSION['id_usuarios']);
                    $usuariosDAO = new usuariosDAO($this->conexao);
                    $retorno = $usuariosDAO->buscarUmUsuario($usuario);

                    var_dump($retorno[0]->id_usuarios);
                    
                    $post = new Posts(titulo:$_POST['titulo'],conteudo:$_POST['conteudo'],datap: date("Y-m-d H:i:s"),usuario:$usuario);
                    $postsDAO = new postsDAO($this->conexao);
                    $post = $postsDAO->inserir($post);

                    $tagsInseridas=[];
                    $tagsNomes = explode(',', $_POST['tags']);
                    
                    $tagDAO= new tagsDAO($this->conexao);
                    
                    foreach ($tagsNomes as $nomeTag){
                        $nomeTag = trim($nomeTag);
                        if ($nomeTag === '') continue;
                        
                        $tag = new Tags(descritivo: $nomeTag);
                        $tag = $tagDAO->inserir($tag); 
                        
                        $tagsInseridas[] = $tag;
                    }

                    $postsTagsDAO = new postsTagsDAO($this->conexao);
                    foreach($tagsInseridas as $tag){
                        $postsTagsDAO->relacionar($post, $tag);
                    }
                    
                    header("location:/ProjetoBlog/");
                    die();
                }
            }
            
            require_once "views/postsInserir.php";
        }

        public function deletar(){
            if(isset($_GET)){
                $post = new Posts(id_posts:$_GET['id']);

                $postsTagsDAO = new postsTagsDAO($this->conexao);
                $relacoes = $postsTagsDAO->buscarPorPost($post);

                foreach($relacoes as $relacao){
                    $postsTags = new postsTags(id_posts_tags: $relacao->id_posts_tags);
                    $postsTagsDAO->deletar($postsTags);
                }

                $postDAO = new postsDAO($this->conexao);
                $postDAO->deletar($post);

                header("location:/ProjetoBlog/");
                die();
            }
        }
    }
?>