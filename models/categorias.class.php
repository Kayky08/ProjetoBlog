<?php 
    class Categorias{
        public function __construct(
            private int $id_categorias = 0,
            private string $cdescritivo = ""
        ){}

        public function getID(){
           return $this->id_categorias;
        }
        public function getDescritivo(){
            return $this->cdescritivo;
        }

        public function setID($id_categorias){
            $this->id_categorias = $id_categorias;
        }
        public function setDescritivo($cdescritivo){
            $this->cdescritivo = $cdescritivo;
        }
    }
?>