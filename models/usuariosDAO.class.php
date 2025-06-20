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
                    WHERE id_usuarios = ?
                    LIMIT 1";

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
            $sql = "INSERT INTO usuarios (nome,tipo,email,senha,imagem) 
                    VALUES (?,?,?,?,?)";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getNome());
                $stm->bindValue(2,$usuario->getTipo());
                $stm->bindValue(3,$usuario->getEmail());
                $stm->bindValue(4,$usuario->getSenha());
                $stm->bindValue(5,$usuario->getImagem());
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
            $sql = "UPDATE usuarios SET nome = ?, tipo = ?, email = ?
                    WHERE id_usuarios = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getNome());
                $stm->bindValue(2,$usuario->getTipo());
                $stm->bindValue(3,$usuario->getEmail());
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

        public function alterarSenha($usuario){
            $sql = "UPDATE usuarios 
                    SET senha = ?
                    WHERE id_usuarios = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$usuario->getSenha());
                $stm->bindValue(2,$usuario->getID());
                $stm->execute();

                $this->db = null;
                return "Senha alterada.";
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao alterar a senha.";
            }
        }

        public function alterarStatus($usuario,$status){
            $sql = "UPDATE usuarios 
                    SET status = ?
                    WHERE id_usuarios = ?";

            try{
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1,$status);
                $stm->bindValue(2,$usuario->getID());
                $stm->execute();

                $this->db = null;
                return "Status Alterado";
            }
            catch(PDOException $e){
                echo $e->getCode();
                echo $e->getMessage();
                echo "Probelma ao alterar o Status.";
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