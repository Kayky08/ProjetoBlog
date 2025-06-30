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
            //Buscando todos os Posts no banco de dados
            $postsDAO = new postsDAO($this->conexao);
            $posts = $postsDAO->BuscarTodosPosts();

            //Buscando todas as categorias para colocar no filtro do select
            $categoriasDAO = new categoriasDAO($this->conexao);
            $categorias = $categoriasDAO->BuscarTodasCategorias();

            require_once "views/postsListar.php";
        }

        public function inserir(){
            //Iniciando a sessão para exibir o header correspondente
            if(!isset($_SESSION)) session_start();

            //Buscando as categorias para inserir no post
            $categoriasDAO = new categoriasDAO($this->conexao);
            $categorias = $categoriasDAO->BuscarTodasCategorias();

        $msg = ["","","","",""];
            $erro = false;
            $tiposImagem = ["image/png","image/jpeg"];

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
                if($_FILES["imagem"]["name"] == "")
				{
					$msg[4] = "Escolha uma Imagem para inserir no post";
					$erro = true;
				}
				else if(!in_array($_FILES["imagem"]["type"], $tiposImagem))
				{
					$msg[4] = "Formato de imagem não suportado";
					$erro = true;
				}

                if(!$erro){
                    //Cria um nome unico para a imagem para que não haja conflitos nos nomes
                    $nomeImagem = uniqid() . "_" . $_FILES['imagem']['name'];
                    //Cria o caminho onde a imagem vai ser salva
                    $caminhoImagem = "src/img/" . $nomeImagem;

                    //Verifica se foi feito o upload da imagem para o diretorio certo se não ela retorna o erro
                    if(!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)){
                        $erro = true;
                        $msg[4] = "Erro ao salvar a imagem.";
                    }

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
                        categoria:$categoria,
                        //Salva o caminho da imagem
                        imagem: $caminhoImagem,
                        tags:explode(',', $_POST['tags'])
                    );

                    //Inserindoo post no banco de dados
                    $postsDAO = new postsDAO($this->conexao);
                    $post = $postsDAO->inserir($post);
                    
                    header("location:/ProjetoBlog/");
                    die();
                }
            }
            
            require_once "views/postsInserir.php";
        }

        public function alterar(){
            if(!isset($_SESSION)) session_start();

            if($_GET){
                $post = new Usuarios(id_usuarios: $_GET['id']);
                $postDAO = new postsDAO($this->conexao);
                $retorno = $postDAO->BuscarUmPost($post);
            }

            //Buscando as categorias para inserir no post
            $categoriasDAO = new categoriasDAO($this->conexao);
            $categorias = $categoriasDAO->BuscarTodasCategorias();

            $msg = ["","","","",""];
            $erro = false;
            $tiposImagem = ["image/png","image/jpeg"];

            //Verificando se recebeu os dados via Post
            if($_POST){
                $caminhoImagem = $_POST['imagemAtual'];

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
                if($_FILES["imagem"]["name"] != "")
				{
					if(!in_array($_FILES["imagem"]["type"], $tiposImagem)){
					    $msg[3] = "Formato de imagem não suportado";
					    $erro = true;
				    }
				}

                if(!$erro){
                    if($_FILES['imagem']['name'] != ""){
                        //Cria um nome unico para a imagem para que não haja conflitos nos nomes
                        $img = uniqid() . "_" . $_FILES['imagem']['name'];
                        //Cria o caminho onde a imagem vai ser salva
                        $caminhoImagem = "src/img/" . $img;

                        //Verifica se foi feito o upload da imagem para o diretorio certo se não ela retorna o erro
                        if(!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)){
                            $erro = true;
                            $msg[4] = "Erro ao salvar a imagem.";
                        }
                        
                        if(unlink($img)) {
                            echo "Arquivo apagado com sucesso.";
                        } else {
                            echo "Erro ao apagar o arquivo.";
                        }
                    }

                    //Buscando a categoria selecionada por meio do select para inserir no post
                    $categoria = new Categorias(id_categorias: $_POST['categoria']);

                    //Criando o novo post com os dados
                    $post = new Posts(
                        id_posts:(int)$_POST['id'],
                        titulo:$_POST['titulo'],
                        conteudo:$_POST['conteudo'],
                        datap: date("Y-m-d H:i:s"),
                        categoria:$categoria,
                        imagem:$caminhoImagem,
                        tags:explode(',', $_POST['tags'])
                    );

                    //Inserindo o post no banco de dados
                    $postsDAO = new postsDAO($this->conexao);
                    $post = $postsDAO->alterar($post);
                    
                    header("location:/ProjetoBlog/");
                    die();
                }
            }

            require_once "views/postsAlterar.php";
        }

        public function deletar(){
            //Verificando se o metodo Get veio com dados
            if(isset($_GET)){
                //Criando um objeto com o id relacionado
                $post = new Posts(id_posts:$_GET['id']);

                //Buscando todos as relações que o post em especifico tem
                $tagsDAO = new tagsDAO($this->conexao);
                $tags = $tagsDAO->buscarPorPost($post);

                //Deletando todas as relações que o post tem
                foreach($tags as $tag){
                    $tags = new Tags(id_tags: $tag->id_tags);
                    $tagsDAO->deletar($tags);
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
                    //Criando o objeto da categoria que sera buscada
                    $categoriaPost = new Categorias(id_categorias:$_POST['categoria']);

                    //Buscando a categoria no banco de dados
                    $postsDAO = new postsDAO($this->conexao);
                    $posts = $postsDAO->buscarPorCategoria($categoriaPost);

                    //Buscando todas as categorias para colocar no filtro do select
                    $categoriasDAO = new categoriasDAO($this->conexao); 
                    $categorias = $categoriasDAO->BuscarTodasCategorias();

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