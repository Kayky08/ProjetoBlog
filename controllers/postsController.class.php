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
                    $post = new Posts(titulo:$_POST['titulo'],conteudo:$_POST['conteudo'],datap: date("Y-m-d H:i:s"));
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

                    //var_dump($this->conexao); die();

                    $postsTagsDAO = new postsTagsDAO($this->conexao);
                    foreach($tagsInseridas as $tag){
                        $postsTagsDAO->relacionar($post->getID(), $tag->getID());
                    }
                    
                    header("location:/ProjetoBlog/listar");
                    die();
                }
            }
            
            require_once "views/postsInserir.php";
        }
    }
?>