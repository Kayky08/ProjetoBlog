<?php 
    class usuariosController{
        private $conexao;

        //Criando a Conexão com o banco de dados
        public function __construct(){
            $this->conexao = Conexao::getInstancia();
        }

        public function listar(){
            //Buscando todas os Usuarios e exibindo
            $usuarioDAO = new usuariosDAO($this->conexao);
            $retorno = $usuarioDAO->buscarTodosUsuarios();

            require_once "views/usuariosListar.php";
        }


        public function inserir(){
            //Iniciando a sessão para exibir o header correspondente
            if(!isset($_SESSION)) session_start();

            $msg = ["","","","",""];
            $erro = false;
            $tiposImagem = ["image/png","image/jpeg"];

            //Verificando se veio dados via Post
            if($_POST){
                //Verificando se os campos não estão vazios
                if(empty($_POST['nome'])){
                    $erro = true;
                    $msg[0] = "Preencha o nome de Usuario.";
                }
                if(empty($_POST['email'])){
                    $erro = true;
                    $msg[1] = "Preencha o E-mail.";
                }
                if(empty($_POST['senha'])){
                    $erro = true;
                    $msg[2] = "Preencha a Senha.";
                }
                if(empty($_POST['vsenha'])){
                    $erro = true;
                    $msg[3] = "Preencha a verificação da Senha.";
                }
                if($_POST['senha'] != $_POST['vsenha']){
                    $erro = true;
                    $msg[3] = "Por favor insira a senhas iguais.";
                }
                if($_FILES["imagem"]["name"] == "")
				{
					$msg[4] = "Escolha uma Imagem para inserir no Usuario";
					$erro = true;
				}
				else if(!in_array($_FILES["imagem"]["type"], $tiposImagem))
				{
					$msg[4] = "Formato de imagem não suportado";
					$erro = true;
				}

                if(!$erro){
                    //Verificanção para saber onde direcionar o usuario
                    if($_SESSION['tipo'] == "administrador"){
                        //Cria um nome unico para a imagem para que não haja conflitos nos nomes
                        $nomeImagem = uniqid() . "_" . $_FILES['imagem']['name'];
                        //Cria o caminho onde a imagem vai ser salva
                        $caminhoImagem = "src/img/" . $nomeImagem;

                        //Verifica se foi feito o upload da imagem para o diretorio certo se não ela retorna o erro
                        if(!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)){
                            $erro = true;
                            $msg[4] = "Erro ao salvar a imagem.";
                        }

                        //Criando o objeto com os dados do Post
                        $usuario = new Usuarios(
                            nome:$_POST['nome'],
                            tipo:'administrador',
                            email:$_POST['email'],
                            senha:md5($_POST['senha']),
                            imagem: $caminhoImagem
                        );

                        //Inserindo o usuaio no banco de dados
                        $usuarioDAO = new usuariosDAO($this->conexao);
                        $usuarioDAO->inserir($usuario);

                        header("location:/ProjetoBlog/listarUsuarios");
                        die();
                    }

                    //Cria um nome unico para a imagem para que não haja conflitos nos nomes
                    $nomeImagem = uniqid() . "_" . $_FILES['imagem']['name'];
                    //Cria o caminho onde a imagem vai ser salva
                    $caminhoImagem = "src/img/" . $nomeImagem;

                    //Verifica se foi feito o upload da imagem para o diretorio certo se não ela retorna o erro
                    if(!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)){
                        $erro = true;
                        $msg[4] = "Erro ao salvar a imagem.";
                    }

                    $usuario = new Usuarios(
                        nome:$_POST['nome'],
                        tipo:'comum',
                        email:$_POST['email'],
                        senha:md5($_POST['senha']),
                        imagem: $caminhoImagem
                    );

                    //Inserindo o usuaio no banco de dados
                    $usuarioDAO = new usuariosDAO($this->conexao);
                    $usuarioDAO->inserir($usuario);

                    //header("location:/ProjetoBlog/login");
                    //die();
                
                }
            }

            require_once "views/usuariosInserir.php";
        }

        public function alterar(){
            //Iniciando a sessão para exibir o header correspondente
            if(!isset($_SESSION)) session_start();

            $msg = ["","","",""];
            $erro = false;
            
            //Verificando se o metodo Get veio com dados
            if(isset($_GET)){
                //Buscando o usuario com relacionado com o id recebido via Get
                $usuario = new Usuarios(id_usuarios:$_GET['id']);
                $usuarioDAO = new usuariosDAO($this->conexao);
                $retorno = $usuarioDAO->buscarUmUsuario($usuario);
            }
            
            //Verificando se recebeu os dados via Post
            if($_POST){                
                //Verificando se os campos não estão vazios
                if(empty($_POST['nome'])){
                    $erro = true;
                    $msg[0] = "Preencha o nome de Usuario.";
                }
                if($_POST['tipo'] == 0 && $_SESSION['tipo'] == 'administrador'){
                    $erro = true;
                    $msg[1] = "Escolha o tipo de Usuário.";
                }
                if(empty($_POST['email'])){
                    $erro = true;
                    $msg[2] = "Preencha o nome de Usuario.";
                }

                if(!$erro){
                    //Verificanção para saber onde direcionar o usuario
                    if($_SESSION['tipo'] == "administrador"){
                        $usuario = new Usuarios(
                            id_usuarios:$_POST['id'],
                            tipo:"administrador",
                            nome:$_POST['nome'],
                            email:$_POST['email']
                        );

                        //Alterando os dados no banco de dados
                        $usuarioDAO->alterar($usuario);

                        $_SESSION['nome'] = $_POST['nome']; 
                        $_SESSION['email'] = $_POST['email'];

                        header("location:/ProjetoBlog/listarUsuarios");
                        die();
                    }
                    else{
                        $usuario = new Usuarios(
                            id_usuarios:$_POST['id'],
                            tipo:'comum',
                            nome:$_POST['nome'],
                            email:$_POST['email']
                        );

                        //Alterando os dados no banco de dados
                        $usuarioDAO->alterar($usuario);

                        $_SESSION['nome'] = $_POST['nome']; 
                        $_SESSION['email'] = $_POST['email'];
                    
                        header("location:/ProjetoBlog/");
                        die();
                    }
                }
            }

            require_once "views/usuariosAlterar.php";
        }

        public function alterarSenha(){
            if(!isset($_SESSION)) session_start();

            $msg = ['',''];
            $erro = false;

            if(isset($_GET)){
                $usuario = new Usuarios(id_usuarios:$_GET['id']);
                $usuarioDAO = new usuariosDAO($this->conexao);
                $retorno = $usuarioDAO->buscarUmUsuario($usuario);
            }

            if($_POST){
                if(empty($_POST['senha'])){
                    $erro = true;
                    $msg[0] = "Preencha a senha.";
                }
                if(empty($_POST['vsenha'])){
                    $erro = true;
                    $msg[1] = "Preencha a verificação da senha.";
                }
                if($_POST['senha'] != $_POST['vsenha']){
                    $erro = true;
                    $msg[1] = "Verifique se as senha são iguais.";
                }

                if(!$erro){
                    $usuario = new Usuarios(id_usuarios:$_POST['id'], senha:md5($_POST['senha']));
                    $usuarioDAO = new usuariosDAO($this->conexao);
                    $usuarioDAO->alterarSenha($usuario);

                    header("location:/ProjetoBlog/perfil");
                    die();
                }
            }

            require_once "views/usuariosAlterarSenha.php";
        }

        public function deletar(){
            //Verificando se o metodo Get veio com dados
            if(isset($_GET)){
                //Criando um objeto com o id do usuario que sera excluido
                $usuario = new Usuarios(id_usuarios:$_GET['id']);

                //Verificando se o usuario fez posts e buscando caso tenha
                $postsDAO = new postsDAO($this->conexao);
                $relacoes = $postsDAO->BuscarPorUsuario($usuario);

                //Excluindo todos os posts que o usuario fez
                foreach($relacoes as $relacao){
                    //Criando um objeto Post com o usuario
                    $post = new Posts(id_posts: $relacao->id_posts);

                    //Bucando o post que esta relacionado com o usuario
                    $tagsDAO = new tagsDAO($this->conexao);
                    $tags = $tagsDAO->buscarPorPost($post);

                    //Deletando todas as relações que o post tem
                    foreach($tags as $tag){
                        $tags = new Tags(id_tags: $tag->id_tags);
                        $tagsDAO->deletar($tags);
                    }

                    //Deletando o post
                    $postDAO = new postsDAO($this->conexao);
                    $postDAO->deletar($post);
                }
                
                //Deletando o usuario 
                $usuarioDAO = new usuariosDAO($this->conexao);
                $usuarioDAO->deletar($usuario);

                header("location:/ProjetoBlog/listarUsuarios");
                die();
            }
        }

        public function perfil(){
            if(!isset($_SESSION)) session_start();

            $usuario = new Usuarios(id_usuarios:$_SESSION['id_usuarios']);

            //Buscando todos os Posts no banco de dados
            $postsDAO = new postsDAO($this->conexao);
            $posts = $postsDAO->buscarPorUsuario($usuario);

            //Buscando todas as categorias para colocar no filtro do select
            $categoriasDAO = new categoriasDAO($this->conexao);
            $categorias = $categoriasDAO->BuscarTodasCategorias();

            require_once "views/usuariosPerfil.php";
        }

        public function login(){
            $msg = ["","",""];

            //Verificando se recebeu os dados via Post
            if($_POST){
                $erro = false;

                //Verificando se os campos não estão vazios
                if(empty($_POST['email'])){
                    $erro = true;
                    $msg[0] = "Preencha a parte de e-mail.";
                }
                if(empty($_POST['senha'])){
                    $erro = true;
                    $msg[1] = "Preencha a parte de senha.";
                }


                if(!$erro){
                    //Criando o objeto do usuario 
                    $usuario = new Usuarios(email:$_POST['email'], senha:md5($_POST['senha']));
                    
                    //Verificando se o usuario esta cadastrado no banco de dados
                    $usuarioDAO = new usuariosDAO($this->conexao);
                    $retorno = $usuarioDAO->verificarUsuario($usuario);                  

                    //Verificando se os dados não estão vazios
                    if(!empty($retorno)){
                        if($retorno[0]->status == 'ativo'){
                            //Criando uma sessão com os dados do usaurio
                            session_start();
                            $_SESSION['id_usuarios'] = $retorno[0]->id_usuarios;
                            $_SESSION['tipo'] = $retorno[0]->tipo;
                            $_SESSION['nome'] = $retorno[0]->nome;
                            $_SESSION['email'] = $retorno[0]->email;

                            header("location:/ProjetoBlog/");
                            die();
                        }
                        else{
                            $msg[2] = "Usuario Bloqueado."; 
                        }
                    }
                    else{
                        $msg[2] = "Confira seu E-mail/Senha."; 
                    }
                }
            }

            require_once "views/usuariosLogin.php";
        }

        public function logout(){
            //Iniciando a sessão
            session_start();
            //Deixando a sessão nula
			$_SESSION = array();
            //Destruindo a sessão
			session_destroy();

            //Redirecionando para a pagina inicial
			header("location:/ProjetoBlog/");
            die();
        }

        public function alterarStatus(){
            if(isset($_GET)){
                $usuario = new Usuarios(id_usuarios:$_GET['id']);
                $usuarioDAO = new usuariosDAO($this->conexao);
                $retorno = $usuarioDAO->buscarUmUsuario($usuario);

                //verificando se o retorno esta vazio
                if(!empty($retorno)){
                    //verificando se o usuario esta ativo ou bloqueado
                    $novoStatus = $retorno[0]->status === 'ativo' ? 'bloqueado' : 'ativo';

                    //altera o status para o novo
                    $usuarioDAO->alterarStatus($usuario, $novoStatus);
                }

                header("location:/ProjetoBlog/listarUsuarios");
                die();
            }
        }
    }
?>