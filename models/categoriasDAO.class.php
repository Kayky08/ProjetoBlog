<?php 
    class categoriasDAO{
        public function __construct(private $db = null){}

            public function BuscarTodasCategorias(){
                $sql = "SELECT * FROM categorias";

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
                    echo "Probelma ao buscar todos as Categorias.";
                }
            }

            public function BuscarUmaCategoria($categoria){
                $sql = "SELECT * FROM categorias WHERE id_categorias = ?";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$categoria->getID());
                    $stm->execute();
                    
                    $this->db = null;
                    return $stm->fetchAll(PDO::FETCH_OBJ);
                }
                catch (PDOException $e){
                    $this->db = null;

                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao buscar uma Categoria.";
                }
            }

            public function inserir($categoria){
                $sql = "INSERT INTO categorias (cdescritivo) VALUES (?)";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$categoria->getDescritivo());
                    $stm->execute();
                    
                    $id = $this->db->lastInsertId();
                    $categoria->setID((int)$id);

                    return $categoria;
                }
                catch (PDOException $e){
                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao inserir a Categoria.";
                    return null;
                }
            }

            public function alterar($categoria){
                $sql = "UPDATE categorias SET descritivo = ? WHERE id_categorias = ?";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$categoria->getDescritivo());
                    $stm->bindValue(2,$categoria->getID());
                    $stm->execute();
                    
                    $this->db = null;
                    return "Categoria alterada com sucesso.";
                }
                catch (PDOException $e){
                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao alterar a Categoria.";
                }
            }

            public function deletar($categoria){
                $sql = "DELETE FROM categorias WHERE id_tags = ?";

                try{
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1,$categoria->getID());
                    $stm->execute();
                    
                    $this->db = null;
                    return "Categoria deletada com sucesso.";
                }
                catch (PDOException $e){
                    echo $e->getCode();
                    echo $e->getMessage();
                    echo "Probelma ao deletar a Categoria.";
                }
            }

            public function verificarNome($tag){
                $sql = "SELECT * FROM categorias WHERE cdescritivo = ?";

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
                    echo "Probelma ao verificar as Categorias.";
                }
            }
    }
?>