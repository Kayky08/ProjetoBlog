<?php 
    class postsDAO{
        public function __construct(private $db = null){}

        public function BuscarTodosPosts(){
            $sql = "SELECT * FROM posts p
                    INNER JOIN tags t
                    ON p.id_tags = t.id_tags";

            try{
                $stm = $this->db->prepare($sql);
                $stm->execute();
                
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e){
                $this->db = null;

                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao buscar todos os Posts.";
            }
        }

        public function BuscarUmPost($post){
            $sql = "SELECT * FROM posts WHERE id_post = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getID());
                $stm->execute();
                
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e){
                $this->db = null;

                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao buscar um Post.";
            }
        }

        public function inserir($post){
            $sql = "INSERT INTO posts (titulo,conteudo,datap,id_tags) VALUES (?,?,?,?)";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getTitulo());
                $stm->bindValue(2,$post->getConteudo());
                $stm->bindValue(3,$post->getData());
                $stm->bindValue(4,$post->getTags()->getID());
                $stm->execute();
                
                $this->db = null;
                return "Post inserido com sucesso.";
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao inserir o post.";
            }
        }

        public function alterar($post){
            $sql = "UPDATE posts SET titulo = ?, conteudo = ? WHERE id_post = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getTitulo());
                $stm->bindValue(2,$post->getConteudo());
                $stm->bindValue(3,$post->getID());
                $stm->execute();
                
                $this->db = null;
                return "Post alterado com sucesso.";
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao altera o Post.";
            }
        }

        public function deletar($post){
            $sql = "DELETE FROM posts WHERE id_post = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getID());
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