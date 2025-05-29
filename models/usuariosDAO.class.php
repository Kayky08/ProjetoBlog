<?php 
    class usuariosDAO{
        public function __construct(private $db = null){}

        public function buscarTodosUsuarios(){
            $sql = "SELECT * 
                    FROM usuarios";

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
                echo "Probelma ao buscar todos os Usuarios.";
            }
        }

        public function buscarUmUsuario($usuario){
            $sql = "SELECT * 
                    FROM usuarios 
                    WHERE id_usuarios = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getID());
                $stm->execute();
                
                $id = $this->db->lastInsertID();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e){
                $this->db = null;

                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao buscar um Usuario.";
            }
        }

        public function inserir($usuario){
            $sql = "INSERT INTO usuarios (nome,tipo,email,senha) 
                    VALUES (?,?,?,?)";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getNome());
                $stm->bindValue(2,$usuario->getTipo());
                $stm->bindValue(3,$usuario->getEmail());
                $stm->bindValue(4,$usuario->getSenha());
                $stm->execute();
                
                $id = $this->db->lastInsertId();
                $usuario->setID((int)$id);

                return $usuario;
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao inserir o Usuario.";
            }
        }

        public function alterar($usuario){
            $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? 
                    WHERE id_usuarios = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getNome());
                $stm->bindValue(2,$usuario->getEmail());
                $stm->bindValue(3,$usuario->getSenha());
                $stm->bindValue(4,$usuario->getID());
                $stm->execute();
                
                $this->db = null;
                return "Usuario alterado com sucesso.";
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao alterar o Usuario.";
            }
        }

        public function deletar($usuario){
            $sql = "DELETE FROM usuarios 
                    WHERE id_usuarios = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getID());
                $stm->execute();
                
                $this->db = null;
                return "Usuario deletado com sucesso.";
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao deletar o Usuario.";
            }
        }

        public function verificarUsuario($usuario){
            $sql = "SELECT *
                    FROM usuarios
                    WHERE email = ? AND senha = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getEmail());
                $stm->bindValue(2,$usuario->getSenha());
                $stm->execute();
                
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao verificar o Usuario.";
            }
        }
    }
?>