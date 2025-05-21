<?php 
    class Tags{
        public function __construct(
            private int $id_tags = 0,
            private string $descritivo = "",
            private $post = null
        ){}

        public function getID(){
           return $this->id_tags;
        }
        public function getDescritivo(){
            return $this->descritivo;
        }

        public function setID($id_tags){
            $this->id_tags = $id_tags;
        }
        public function setDescritivo($descritivo){
            $this->descritivo = $descritivo;
        }
    }
?>