<?php
    require_once 'Conexao.php';

    class PedidoDAO {

        public function getPedidos() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM pedido;";  

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createPedido(PedidoModel $pedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO pedido (id_usuario) VALUES (:id_usuario);";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id_usuario', $pedido->id_usuario);

            return $stmt->execute();
        }

        public function updatePedido(PedidoModel $pedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE pedido SET id_usuario = :id_usuario WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $pedido->id);
            $stmt->bindValue(':id_usuario', $pedido->id_usuario);

            return $stmt->execute();
        }

        public function deletePedido(PedidoModel $pedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM pedido WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $pedido->id);

            return $stmt->execute();
        }

        public function getPedido($idPedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM pedido WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idPedido);  
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getPedidoByIdAndIdUsuario($id, $id_usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM pedido WHERE id = :id AND id_usuario = :id_usuario;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id_usuario', $id_usuario);  
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>
