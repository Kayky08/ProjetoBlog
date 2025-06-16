<?php 
    class postsDAO{
        public function __construct(private $db = null){}

        public function BuscarTodosPosts(){
            $sql = "SELECT p.id_posts, p.titulo, p.datap, 
                           p.conteudo, u.nome AS usuario,
                           c.cdescritivo as categoria,
                           GROUP_CONCAT(t.descritivo SEPARATOR ', ') AS tags
                    FROM posts p
                    INNER JOIN posts_tags pt 
                    ON p.id_posts = pt.id_posts
                    INNER JOIN tags t 
                    ON t.id_tags = pt.id_tags
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
            $sql = "SELECT * FROM posts p
                    INNER JOIN posts_tags pt
                    ON p.id_posts = pt.id_posts
                    INNER JOIN tags t
                    ON t.id_tags = pt.id_tags
                    INNER JOIN usuarios u
                    on u.id_usuarios = p.id_usuarios
                    INNER JOIN categorias c
                    on c.id_categorias = p.id_categorias
                    WHERE p.id_post = ?";

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
                    INNER JOIN posts_tags pt 
                    ON p.id_posts = pt.id_posts
                    INNER JOIN tags t 
                    ON t.id_tags = pt.id_tags
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

            try{
                //Iniciando a transação, para garantir que eu possa utilizar o rollback caso uma das operações falhe
                $this->db->beginTransaction();

                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$post->getTitulo());
                $stm->bindValue(2,$post->getConteudo());
                $stm->bindValue(3,$post->getData());
                $stm->bindValue(4,$post->getUsuario()->getID());
                $stm->bindValue(5,$post->getCategoria()->getID());
                $stm->execute();
                
                $idPost = $this->db->lastInsertId();
                $post->setID((int)$idPost);

                //Inserindo as tags

                //Verificando se a tag existe no banco de dados
                foreach($post->getTags() as $tag){
                    $sql2 = "SELECT id_tags 
                            FROM tags 
                            WHERE descritivo = ?";
                    
                    $stm2 = $this->db->prepare($sql2);
                    $stm2->bindValue(1,$tag->getDescritivo());

                    //Buscando o id da tag no banco de dados
                    $idTag = $stm2->fetchColumn();

                    //Inserindo a tag caso ela não exita no banco de dados
                    if(!$idTag){
                        $sql3 = "INSERT INTO tags (descritivo) VALUES (?)";

                        $stm3 = $this->db->prepare($sql3);
                        $stm3->bindValue(1,$tag->getDescritivo());
                        $stm3->execute();

                        //Pegando o id da nova tag
                        $idTag = $this->db->lastInsertId();
                    }

                    //Relacionando as tags com os posts
                    $sql4 = "INSERT INTO posts_tags (id_posts, id_tags) VALUES (?,?)";

                    $stm4 = $this->db->prepare($sql4);
                    $stm4->bindValue(1,$idPost);
                    $stm4->bindValue(2,$idTag);
                    $stm4->execute();
                }

                //Se tudo estiver certo finaliza a transição e adiciona no banco de dados
                $this->db->commit();
                
                return $post;
            }
            catch (PDOException $e){
                //Se caso alguma coisa falhe, não insere no banco de dados e desfaz todas as operações
                $this->db->rollBack();

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