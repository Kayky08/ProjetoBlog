<?php
    date_default_timezone_set("America/Sao_Paulo");

    class postsController{
        private $conexao;

        public function __construct(){
            $this->conexao = Conexao::getInstancia();
        }

        public function listar(){
            $postsAgrupados = [];
            
            $postsDAO = new postsDAO($this->conexao);
            $posts = $postsDAO->BuscarTodosPosts();

            $categoriasDAO = new categoriasDAO($this->conexao);
            $categorias = $categoriasDAO->BuscarTodasCategorias();

            foreach ($posts as $post) {
                $id = $post->id_posts;

                if (!isset($postsAgrupados[$id])) {
                    $postsAgrupados[$id] = [
                        'id' => $post->id_posts,
                        'titulo' => $post->titulo,
                        'datap' => $post->datap,
                        'conteudo' => $post->conteudo,
                        'usuario' => $post->nome,
                        'categoria' => $post->cdescritivo,
                        'tags' => []
                    ];
                }

                $postsAgrupados[$id]['tags'][] = $post->descritivo;
            }

            require_once "views/postsListar.php";
        }

        public function inserir(){
            if(!isset($_SESSION)) session_start();


            $categoriasDAO = new categoriasDAO($this->conexao);
            $categorias = $categoriasDAO->BuscarTodasCategorias();

            $msg = ["","","",""];
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
                if($_POST['categoria'] == 0){
                    $erro = true;
                    $msg[3] = "Escolha uma Categoria.";
                }

                if(!$erro){
                    $usuario = new Usuarios(id_usuarios: $_SESSION['id_usuarios']);
                    $categoria = new Categorias(id_categorias: $_POST['categoria']);

                    $post = new Posts(titulo:$_POST['titulo'],conteudo:$_POST['conteudo'],datap: date("Y-m-d H:i:s"),usuario:$usuario,categoria:$categoria);

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

        public function filtrar(){
            if($_POST){
                if($_POST['categoria'] > 0){
                    $postsAgrupados = [];

                    $categoriaPost = new Categorias(id_categorias:$_POST['categoria']);

                    $postsDAO = new postsDAO($this->conexao);
                    $posts = $postsDAO->buscarPorCategoria($categoriaPost);

                    $categoriasDAO = new categoriasDAO($this->conexao); 
                    $categorias = $categoriasDAO->BuscarTodasCategorias();

                    foreach ($posts as $post) {
                        $id = $post->id_posts;

                        if (!isset($postsAgrupados[$id])) {
                            $postsAgrupados[$id] = [
                                'id' => $post->id_posts,
                                'titulo' => $post->titulo,
                                'datap' => $post->datap,
                                'conteudo' => $post->conteudo,
                                'usuario' => $post->nome,
                                'categoria' => $post->cdescritivo,
                                'tags' => []
                            ];
                        }

                        $postsAgrupados[$id]['tags'][] = $post->descritivo;
                    }

                    require_once "views/postsListar.php";
                }
                else{
                    header("location:/ProjetoBlog/");
                    die();
                }
            }
        }
    }
?>