<?php 
    class Posts{
        public function __construct(
            private int $id_posts = 0,
            private string $titulo = "",
            private string $conteudo = "",
            private string $datap = "",
            private array $tags = array()
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
        public function getTags(){
            return $this->tags;
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
        public function setTag($tags){
            $this->tags[] = $tags;
        }
    }
?>