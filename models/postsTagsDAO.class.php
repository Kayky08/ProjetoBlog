<?php 
    class postsTagsDAO{
        public function __construct(private $db = null){}

        public function buscarPorPost($post){
            $sql = "SELECT * FROM posts_tags WHERE id_posts = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getID());
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Falha ao buscar relações pelo Post.";
            }
        }

        public function buscarPorTag($tag){
            $sql = "SELECT * FROM posts_tags WHERE id_tags = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$tag->getID());
                $stm->execute();

                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Falha ao buscar relações pela Tag.";
            }
        }

        public function relacionar($post,$tag){
            $sql = "INSERT INTO posts_tags (id_posts,id_tags) VALUES (?,?)";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getID());
                $stm->bindValue(2,$tag->getID());
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

        public function deletar($post_tag){
            $sql = "DELETE FROM posts_tags WHERE id_posts_tags = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post_tag->getID());
                $stm->execute();
                
                return "Relação deletada com sucesso.";
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao deletar a Relação.";
            }
        }
    }
?>