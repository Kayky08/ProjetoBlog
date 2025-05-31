<?php 
    class postsDAO{
        public function __construct(private $db = null){}

        public function BuscarTodosPosts(){
            $sql = "SELECT * FROM posts p
                    INNER JOIN posts_tags pt
                    ON p.id_posts = pt.id_posts
                    INNER JOIN tags t
                    ON t.id_tags = pt.id_tags
                    INNER JOIN usuarios u
                    on u.id_usuarios = p.id_usuarios
                    INNER JOIN categorias c
                    on c.id_categorias = c.id_categorias
                    GROUP BY p.id_posts";

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
            $sql = "SELECT * FROM posts p
                    INNER JOIN posts_tags pt
                    ON p.id_posts = pt.id_posts
                    INNER JOIN tags t
                    ON t.id_tags = pt.id_tags
                    INNER JOIN usuarios u
                    on u.id_usuarios = p.id_usuarios
                    INNER JOIN categorias c
                    on c.id_categorias = c.id_categorias
                    WHERE id_post = ?";

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
            $sql = "INSERT INTO posts (titulo,conteudo,datap,id_usuarios,id_categorias) VALUES (?,?,?,?,?)";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getTitulo());
                $stm->bindValue(2,$post->getConteudo());
                $stm->bindValue(3,$post->getData());
                $stm->bindValue(4,$post->getUsuario()->getID());
                $stm->bindValue(5,$post->getCategoria()->getID());
                $stm->execute();
                
                $id = $this->db->lastInsertId();
                $post->setID((int)$id);

                return $post;
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao inserir o post.";
            }
        }

        public function deletar($post){
            $sql = "DELETE FROM posts WHERE id_posts = ?";

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