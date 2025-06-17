<?php 
    class postsDAO{
        public function __construct(private $db = null){}

        public function BuscarTodosPosts(){
            $sql = "SELECT p.id_posts, p.titulo, p.datap, 
                           p.conteudo, u.nome AS usuario,
                           c.cdescritivo as categoria,
                           GROUP_CONCAT(t.descritivo SEPARATOR ', ') AS tags
                    FROM posts p
                    INNER JOIN tags t 
                    ON t.id_posts = p.id_posts
                    INNER JOIN usuarios u
                    ON u.id_usuarios = p.id_usuarios
                    INNER JOIN categorias c
                    ON p.id_categorias = c.id_categorias
                    GROUP BY p.id_posts
                    ORDER BY p.id_posts DESC";

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
            $sql = "SELECT p.id_posts, p.titulo, p.datap, 
                           p.conteudo, u.nome AS usuario,
                           c.cdescritivo as categoria,
                           GROUP_CONCAT(t.descritivo SEPARATOR ', ') AS tags
                    FROM posts p
                    INNER JOIN tags t 
                    ON t.id_posts = p.id_posts
                    INNER JOIN usuarios u
                    ON u.id_usuarios = p.id_usuarios
                    INNER JOIN categorias c
                    ON p.id_categorias = c.id_categorias
                    WHERE p.id_posts = ?";

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

        public function buscarPorUsuario($usuario){
            $sql = "SELECT * FROM posts WHERE id_usuarios = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getID());
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Falha ao buscar relações pelo Usuario.";
            }
        }

        public function buscarPorCategoria($categoria){
            $sql = "SELECT p.id_posts, p.titulo, p.datap, 
                           p.conteudo, u.nome AS usuario,
                           c.cdescritivo as categoria,
                           GROUP_CONCAT(t.descritivo SEPARATOR ', ') AS tags
                    FROM posts p
                    INNER JOIN tags t 
                    ON t.id_posts = p.id_posts
                    INNER JOIN usuarios u
                    ON u.id_usuarios = p.id_usuarios
                    INNER JOIN categorias c
                    ON p.id_categorias = c.id_categorias
                    WHERE p.id_categorias = ?
                    GROUP BY p.id_posts
                    ORDER BY p.id_posts DESC
                    ";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$categoria->getID());
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Falha ao buscar relações pela Categoria.";
            }
        }

        public function inserir($post){
            $sql = "INSERT INTO posts (titulo,conteudo,datap,id_usuarios,id_categorias) VALUES (?,?,?,?,?)";

            //Iniciando a transação, para garantir que eu possa utilizar o rollback caso uma das operações falhe
            $this->db->beginTransaction();

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getTitulo());
                $stm->bindValue(2,$post->getConteudo());
                $stm->bindValue(3,$post->getData());
                $stm->bindValue(4,$post->getUsuario()->getID());
                $stm->bindValue(5,$post->getCategoria()->getID());
                $stm->execute();
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();

                return "Erro ao inserir o Post.";
            }
            
            $idPost = $this->db->lastInsertId();

            //Inserindo as tags
            $sql3 = "INSERT INTO tags (descritivo, id_posts) VALUES (?,?)";

            //Verificando se a tag existe no banco de dados
            try{
                foreach($post->getTags() as $tag){
                    //Inserindo a tag caso ela não exita no banco de dados
                    $stm3 = $this->db->prepare($sql3);
                    $stm3->bindValue(1,$tag);
                    $stm3->bindValue(2,$idPost);
                    $stm3->execute();
                }
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();

                $this->db->rollBack();
                $this->db = null;

                return "Problema ao inserir a tag.";
            }

            //Se tudo estiver certo finaliza a transição e adiciona no banco de dados
            $this->db->commit();
            
            return $post;
        }

        public function alterar($post){
            $sql = "UPDATE posts 
                    SET titulo = ?, conteudo = ?, datap = ?, id_categorias = ? 
                    WHERE id_posts = ?";

            $this->db->beginTransaction();

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getTitulo());
                $stm->bindValue(2,$post->getConteudo());
                $stm->bindValue(3,$post->getData());
                $stm->bindValue(4,$post->getCategoria()->getID());
                $stm->bindValue(5,$post->getID());
                $stm->execute();
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();

                return "Erro ao alterar o Post.";
            }

            //Deletando as tags atuais
            $sql2 = "DELETE FROM tags WHERE id_posts = ?";

            try{
                $stm2 = $this->db->prepare($sql2);
                $stm2->bindValue(1,$post->getID());
                $stm2->execute();
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();

                $this->db->rollBack();
                $this->db = null;

                return "Erro ao deletar as Tags.";
            }

            $sql3 = "INSERT INTO tags (descritivo, id_posts) VALUES (?,?)";

            try{
                foreach($post->getTags() as $tag){
                    $stm3 = $this->db->prepare($sql3);
                    $stm3->bindValue(1,trim($tag));
                    $stm3->bindValue(2,$post->getID());
                    $stm3->execute();
                }
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();

                $this->db->rollBack();
                $this->db = null;

                return "Erro ao Inserir as Tags.";
            }

            $this->db->commit();
            return "Post alterado com sucesso.";
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