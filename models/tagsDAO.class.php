<?php 
    class tagsDAO{
        public function __construct(private $db = null){}

            public function BuscarTodasTags(){
                $sql = "SELECT * FROM tags";

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
                    echo "Probelma ao buscar todos as Tags.";
                }
            }

            public function BuscarUmaTag($tag){
                $sql = "SELECT * FROM tags WHERE id_tags = ?";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$tag->getID());
                    $stm->execute();
                    
                    $this->db = null;
                    return $stm->fetchAll(PDO::FETCH_OBJ);
                }
                catch (PDOException $e){
                    $this->db = null;

                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao buscar uma Tag.";
                }
            }

            public function inserir($tag){
                $sql = "INSERT INTO tags (descritivo) VALUES (?)";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$tag->getDescritivo());
                    $stm->execute();
                    
                    $id = $this->db->lastInsertId();
                    $tag->setID((int)$id);

                    return $tag;
                }
                catch (PDOException $e){
                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao inserir a Tag.";
                    return null;
                }
            }

            public function alterar($tag){
                $sql = "UPDATE tags SET descritivo = ? WHERE id_tags = ?";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$tag->getDescritivo());
                    $stm->bindValue(3,$tag->getID());
                    $stm->execute();
                    
                    $this->db = null;
                    return "Tag alterada com sucesso.";
                }
                catch (PDOException $e){
                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao alterar a Tag.";
                }
            }

            public function deletar($tag){
                $sql = "DELETE FROM tags WHERE id_tags = ?";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$tag->getID());
                    $stm->execute();
                    
                    $this->db = null;
                    return "Tag deletada com sucesso.";
                }
                catch (PDOException $e){
                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao deletar a Tag.";
                }
            }

            public function verificarNome($tag){
                $sql = "SELECT * FROM tags WHERE descritivo = ?";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$tag->getDescritivo());
                    $stm->execute();
                    
                    $this->db = null;
                    return $stm->fetchAll(PDO::FETCH_OBJ);
                }
                catch (PDOException $e){
                    $this->db = null;

                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao verificar as Tags.";
                }
            }
    }
?>