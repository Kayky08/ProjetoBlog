<?php 
    class usuariosController{
        private $conexao;

        public function __construct(){
            $this->conexao = Conexao::getInstancia();
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
                    $usuario = new Usuarios(email:$_POST['email'], senha:md5($_POST['senha']));
                    
                    $usuarioDAO = new usuariosDAO($this->conexao);
                    $retorno = $usuarioDAO->verificarUsuario($usuario);

                    if(count($retorno) > 0){
                        session_start();
                        $_SESSION['id_usuarios'] = $retorno[0]->id_usuarios;
                        $_SESSION['tipo'] = $retorno[0]->tipo;

                        header("location:index.php");
                    }
                    else{
                        $msg[2] = "Confira seu E-mail/Senha."; 
                    }
                }
            }

            require_once "views/usuariosLogin.php";
        }

        public function listar(){
            $usuarioDAO = new usuariosDAO($this->conexao);
            $retorno = $usuarioDAO->buscarTodosUsuarios();

            require_once "views/usuariosListar.php";
        }


        public function inserir(){
            $msg = ["","","",""];
            $erro = false;
            
            if($_POST){
                if(empty($_POST['nome'])){
                    $erro = true;
                    $msg[0] = "Preencha o nome de Usuario.";
                }
                if(empty($_POST['email'])){
                    $erro = true;
                    $msg[1] = "Preencha o nome de Usuario.";
                }
                if($_POST['senha'] != $_POST['vsenha']){
                    $erro = true;
                    $msg[4] = "Por favor insira a senhas iguais.";
                }

                if(!$erro){
                    $usuario = new Usuarios(nome:$_POST['nome'],tipo:'comum',email:$_POST['email'],senha:md5($_POST['senha']));
                    $usuarioDAO = new usuariosDAO($this->conexao);
                    $usuarioDAO->inserir($usuario);

                    header("location:/ProjetoBlog/listarUsuarios");
                    die();
                }
            }

            require_once "views/usuariosInserir.php";
        }

        public function alterar(){ 
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

                    header("location:/ProjetoBlog/listarUsuarios");
                    die();
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
    }
?>