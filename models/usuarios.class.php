<?php 
    class Usuaios{
        public function __construct(
            private int $id_usuarios = 0,
            private string $nome = "",
            private string $email = "",
            private string $senha = "",
            private array $posts = array()
        ){}

        public function getID(){
            return $this->id_usuarios;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getSenha(){
            return $this->senha;
        }
        public function getPosts(){
            return $this->posts;
        }

        public function setID($id_usuarios){
            $this->id_usuarios = $id_usuarios;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function setSenha($senha){
            $this->senha = $senha;
        }
        public function setPosts($posts){
            $this->posts[] = $posts;
        }
    }
?>