<?php 
    class usuariosController{
        private $conexao;

        public function __construct(){
            $this->conexao = Conexao::getInstancia();
        }

        public function listar(){
            $usuarioDAO = new usuariosDAO($this->conexao);
            $retorno = $usuarioDAO->buscarTodosUsuarios();

            require_once "views/usuariosListar.php";
        }


        public function inserir(){
            if(!isset($_SESSION)) session_start();

            $msg = ["","","",""];
            $erro = false;

            if($_POST){
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

                if(!$erro){
                    $usuario = new Usuarios(nome:$_POST['nome'],tipo:'comum',email:$_POST['email'],senha:md5($_POST['senha']));
                    $usuarioDAO = new usuariosDAO($this->conexao);
                    $usuarioDAO->inserir($usuario);

                    if($_SESSION['tip'] == "administrador"){
                        header("location:/ProjetoBlog/listarUsuarios");
                        die();
                    }
                    else{
                        header("location:/ProjetoBlog/login");
                        die();
                    }
                }
            }

            require_once "views/usuariosInserir.php";
        }

        public function alterar(){
            if(!isset($_SESSION)) session_start();

            $msg = ["","","",""];
            
            if(isset($_GET)){
                $usuario = new Usuarios(id_usuarios:$_GET['id']);
                $usuarioDAO = new usuariosDAO($this->conexao);
                $retorno = $usuarioDAO->buscarUmUsuario($usuario);
            }
            
            if($_POST){
                $erro = false;
                
                if(empty($_POST['nome'])){
                    $erro = true;
                    $msg[0] = "Preencha o nome de Usuario.";
                }
                if(empty($_POST['email'])){
                    $erro = true;
                    $msg[1] = "Preencha o nome de Usuario.";
                }
                if(empty($_POST['senha'])){
                    $erro = true;
                    $msg[2] = "Preencha o nome de Usuario.";
                }
                if(empty($_POST['vsenha'])){
                    $erro = true;
                    $msg[3] = "Preencha o nome de Usuario.";
                }
                if($_POST['senha'] != $_POST['vsenha']){
                    $erro = true;
                    $msg[4] = "Por favor insira a senhas iguais.";
                }

                if(!$erro){
                    $usuario = new Usuarios(id_usuarios:$_POST['id'],nome:$_POST['nome'],email:$_POST['email'],senha:md5($_POST['senha']));
                    $usuarioDAO = new usuariosDAO($this->conexao);
                    $usuarioDAO->alterar($usuario);

                    if($_SESSION['tipo'] == "administrador"){
                        header("location:/ProjetoBlog/listarUsuarios");
                        die();
                    }
                    else{
                        $_SESSION['nome'] = $_POST['nome'];
                    
                        header("location:/ProjetoBlog/");
                        die();
                    }
                }
            }

            require_once "views/usuariosAlterar.php";
        }

        public function deletar(){
            if(isset($_GET)){
                $usuario = new Usuarios(id_usuarios:$_GET['id']);
                $usuarioDAO = new usuariosDAO($this->conexao);
                $usuarioDAO->deletar($usuario);

                header("location:/ProjetoBlog/listarUsuarios");
                die();
            }
        }

        public function login(){
            $msg = ["","",""];

            if($_POST){
                $erro = false;

                if(empty($_POST['email'])){
                    $erro = true;
                    $msg[0] = "Preencha a parte de e-mail.";
                }
                if(empty($_POST['senha'])){
                    $erro = true;
                    $msg[1] = "Preencha a parte de senha.";
                }

                if(!$erro){
                    if($_POST['email'] == "admin@admin.com" && $_POST['senha'] == "admin"){
                        $usuario = new Usuarios(email:$_POST['email'], senha:$_POST['senha']);
                    
                        $usuarioDAO = new usuariosDAO($this->conexao);
                        $retorno = $usuarioDAO->verificarUsuario($usuario);                   

                        if(!empty($retorno)){
                            session_start();
                            $_SESSION['id_usuarios'] = $retorno[0]->id_usuarios;
                            $_SESSION['tipo'] = $retorno[0]->tipo;
                            $_SESSION['nome'] = $retorno[0]->nome;
                            $_SESSION['email'] = $retorno[0]->email;


                            header("location:/ProjetoBlog/");
                            die();
                        }
                        else{
                            $msg[2] = "Confira seu E-mail/Senha."; 
                        }
                    }

                    $usuario = new Usuarios(email:$_POST['email'], senha:md5($_POST['senha']));
                    
                    $usuarioDAO = new usuariosDAO($this->conexao);
                    $retorno = $usuarioDAO->verificarUsuario($usuario);                   

                    if(!empty($retorno)){
                        session_start();
                        $_SESSION['id_usuarios'] = $retorno[0]->id_usuarios;
                        $_SESSION['tipo'] = $retorno[0]->tipo;
                        $_SESSION['nome'] = $retorno[0]->nome;
                        $_SESSION['email'] = $retorno[0]->email;


                        header("location:/ProjetoBlog/");
                        die();
                    }
                    else{
                        $msg[2] = "Confira seu E-mail/Senha."; 
                    }
                }
            }

            require_once "views/usuariosLogin.php";
        }

        public function logout(){
            session_start();
			$_SESSION = array();
			session_destroy();

			header("location:/ProjetoBlog/");
        }
    }
?>