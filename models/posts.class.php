<?php 
    class Posts{
        public function __construct(
            private int $id_posts = 0,
            private string $titulo = "",
            private string $conteudo = "",
            private string $datap = "",
            private string $imagem = "",
            private array $tags = array(),
            private $categoria = null,
            private $usuario = null,
        ){}

        public function getID(){
            return $this->id_posts;
        }
        public function getTitulo(){
            return $this->titulo;
        }
        public function getConteudo(){
            return $this->conteudo;
        }
        public function getData(){
            return $this->datap;
        }
        public function getImagem(){
            return $this->imagem;
        }
        public function getTags(){
            return $this->tags;
        }
        public function getCategoria(){
            return $this->categoria;
        }
        public function getUsuario(){
            return $this->usuario;
        }

        public function setID($id_posts){
            $this->id_posts = $id_posts;
        }
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }
        public function setConteudo($conteudo){
            $this->conteudo = $conteudo;
        }
        public function setData($datap){
            $this->datap = $datap;
        }
        public function setImagem($imagem){
            $this->imagem = $imagem;
        }
        public function setTags($tags){
            $this->tags[] = $tags;
        }
        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
    }
?>