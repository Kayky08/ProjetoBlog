<?php
    //Definindo o horario e data de agora
    date_default_timezone_set("America/Sao_Paulo");

    class postsController{
        private $conexao;

        //Criando a Conexão com o banco de dados
        public function __construct(){
            $this->conexao = Conexao::getInstancia();
        }

        public function listar(){
            //Criando o Array onde vai ficar os posts de forma organizada
            $postsAgrupados = [];
            
            //Buscando todos os Posts no banco de dados
            $postsDAO = new postsDAO($this->conexao);
            $posts = $postsDAO->BuscarTodosPosts();

            //Buscando todas as categorias para colocar no filtro do select
            $categoriasDAO = new categoriasDAO($this->conexao);
            $categorias = $categoriasDAO->BuscarTodasCategorias();

            //Organizando os posts para exibir na pagina inicial
            foreach ($posts as $post) {
                $id = $post->id_posts;

                //Verificando se o Arry veio nulo
                if (!isset($postsAgrupados[$id])) {
                    //Organizando com relação as colunas do banco de dados com os nomes
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

                //Inserindo todas as tags no array
                $postsAgrupados[$id]['tags'][] = $post->descritivo;
            }

            require_once "views/postsListar.php";
        }

        public function inserir(){
            //Iniciando a sessão para exibir o header correspondente
            if(!isset($_SESSION)) session_start();

            //Buscando as categorias para inserir no post
            $categoriasDAO = new categoriasDAO($this->conexao);
            $categorias = $categoriasDAO->BuscarTodasCategorias();

            $msg = ["","","",""];
            $erro = false;

            //Verificando se recebeu os dados via Post
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
                    //Buscando o usuario atual para inserir no post
                    $usuario = new Usuarios(id_usuarios: $_SESSION['id_usuarios']);
                    //Buscando a categoria selecionada por meio do select para inserir no post
                    $categoria = new Categorias(id_categorias: $_POST['categoria']);

                    //Criando o novo post com os dados
                    $post = new Posts(
                        titulo:$_POST['titulo'],
                        conteudo:$_POST['conteudo'],
                        datap: date("Y-m-d H:i:s"),
                        usuario:$usuario,
                        categoria:$categoria
                    );

                    //Inserindoo post no banco de dados
                    $postsDAO = new postsDAO($this->conexao);
                    $post = $postsDAO->inserir($post);

                    //Criando o Array para inserir as tags
                    $tagsInseridas=[];
                    //Pegando as tags colocadas separadas por virgula
                    $tagsNomes = explode(',', $_POST['tags']);
                    
                    $tagDAO= new tagsDAO($this->conexao);
                    
                    //Verificando os nomes das tags e inserindo no banco de dados
                    foreach ($tagsNomes as $nomeTag){
                        //Retirando os espaços na string
                        $nomeTag = trim($nomeTag);
                        
                        //Verificando se acabou as tags e prosseguindo
                        if ($nomeTag === '') continue;
                        
                        //Inserindo as tags no banco de dados
                        $tag = new Tags(descritivo: $nomeTag);
                        $tag = $tagDAO->inserir($tag); 
                        
                        //Colocando as tags no Array para relacionar com o post
                        $tagsInseridas[] = $tag;
                    }

                    //Realacionando tags com o post
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
            //Verificando se o metodo Get veio com dados
            if(isset($_GET)){
                //Criando um objeto com o id relacionado
                $post = new Posts(id_posts:$_GET['id']);

                //Buscando todos as relações que o post em especifico tem
                $postsTagsDAO = new postsTagsDAO($this->conexao);
                $relacoes = $postsTagsDAO->buscarPorPost($post);

                //Deletando todas as relações que o post tem
                foreach($relacoes as $relacao){
                    $postsTags = new postsTags(id_posts_tags: $relacao->id_posts_tags);
                    $postsTagsDAO->deletar($postsTags);
                }

                //Deletando o post do banco de dados
                $postDAO = new postsDAO($this->conexao);
                $postDAO->deletar($post);

                header("location:/ProjetoBlog/");
                die();
            }
        }

        public function filtrar(){
            //Verificando se veio os dados via $_POST
            if($_POST){
                //Verificando se a categoria selecionada é valida
                if($_POST['categoria'] > 0){
                    //Criando o Array onde vai ficar os posts de forma organizada
                    $postsAgrupados = [];

                    //Criando o objeto da categoria que sera buscada
                    $categoriaPost = new Categorias(id_categorias:$_POST['categoria']);

                    //Buscando a categoria no banco de dados
                    $postsDAO = new postsDAO($this->conexao);
                    $posts = $postsDAO->buscarPorCategoria($categoriaPost);

                    //Buscando todas as categorias para colocar no filtro do select
                    $categoriasDAO = new categoriasDAO($this->conexao); 
                    $categorias = $categoriasDAO->BuscarTodasCategorias();

                    foreach ($posts as $post) {
                        $id = $post->id_posts;

                        //Verificando se o Arry veio nulo
                        if (!isset($postsAgrupados[$id])) {
                            //Organizando com relação as colunas do banco de dados com os nomes
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

                        //Inserindo todas as tags no array
                        $postsAgrupados[$id]['tags'][] = $post->descritivo;
                    }

                    require_once "views/postsListar.php";
                }
                else{
                    //Redirecionando para a mesma pagina caso não tenha selecionado nenhuma categoria
                    header("location:/ProjetoBlog/");
                    die();
                }
            }
        }
    }
?>