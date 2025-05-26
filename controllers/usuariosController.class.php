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
                if(empty($_POST['senha'])){
                    $erro = true;
                    $msg[2] = "Preencha o nome de Usuario.";
                }

                if(!$erro){
                    $usuario = new Usuarios(nome:$_POST['nome'],email:$_POST['email'],senha:md5($_POST['senha']));
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
            $erro = false;
            
            if(isset($_GET)){
                $usuario = new Usuarios(id_usuarios:$_GET['id']);
                $usuarioDAO = new usuariosDAO($this->conexao);
                $retorno = $usuarioDAO->buscarUmUsuario($usuario);
            }

            if($_POST){
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
                if($_POST['senha'] == $_POST['vsenha']){
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
            # code...
        }
    }
?>