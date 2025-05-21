<?php 
    class postsTagsDAO{
        public function __construct(private $db = null){}

        public function relacinar($post,$tag){
            $sql = "INSERT INTO posts_tags (id_posts,id_tags) VALUES (?,?)";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getID());
                $stm->bindValue(1,$tag->getID());
                $stm->execute();

                $this->db = null;
                return "Relação realizada com sucesso.";
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Erro ao relacionar";
            }
        }
    }
?>