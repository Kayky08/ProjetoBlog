<?php 
    class postsTagsDAO{
        public function __construct(private $db = null){}

        public function relacionar($idpost,$idtag){
            $sql = "INSERT INTO posts_tags (id_posts,id_tags) VALUES (?,?)";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$idpost);
                $stm->bindValue(2,$idtag);
                $stm->execute();

                //$this->db = null;
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