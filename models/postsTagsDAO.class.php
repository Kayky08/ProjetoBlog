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

        public function deletar($post){
            $sql = "DELETE FROM posts_tags WHERE id_posts = ? AND id_tags = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getID());
                $stm->bindValue(2,$post->getID());
                $stm->execute();
                
                $this->db = null;
                return "Post deletado com sucesso.";
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao deletar o Post.";
            }
        }
    }
?>