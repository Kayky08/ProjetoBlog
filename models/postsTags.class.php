<?php 
    class postsTags{
        public function __construct(
            private int $id_posts_tags = 0,
            private $post = null,
            private $tag = null,
        ){}

        public function getID(){
            return $this->id_posts_tags;
        }
        public function getPost(){
            return $this->id_posts_tags;
        }
        public function getTag(){
            return $this->id_posts_tags;
        }

        public function setID($id_posts_tags){
            $this->id_posts_tags = $id_posts_tags;
        }
        public function setPost($post){
            $this->post = $post;
        }
        public function setTag($tag){
            $this->tag = $tag;
        }
    }
?>