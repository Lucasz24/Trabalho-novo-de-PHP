<?php
    require_once 'Conexao.php';

    class ProdutoDAO {

        public function getItens() {
            $conexao = (new Conexao())->getConexao();  

            $sql = "SELECT * FROM item;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createItem(ItemModel $item) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO item (id, pedidoId, produtoId, quantidade) 
                    VALUES (:id, :pedidoId, :produtoId, :quantidade);";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $item->id);
            $stmt->bindValue(':pedidoId', $item->pedidoId);
            $stmt->bindValue(':produtoId', $item->produtoId);
            $stmt->bindValue(':quantidade', $item->quantidade);

            return $stmt->execute();
        }

        public function updateItem(ItemModel $item) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE item 
                    SET pedidoId = :pedidoId, produtoId = :produtoId, quantidade = :quantidade 
                    WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $item->id);
            $stmt->bindValue(':pedidoId', $item->pedidoId);
            $stmt->bindValue(':produtoId', $item->produtoId);
            $stmt->bindValue(':quantidade', $item->quantidade);

            return $stmt->execute();
        }

       
        public function deleteItem(ItemModel $item) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM item WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $item->id);

            return $stmt->execute();
        }

        
        public function getItem($idItem) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM item WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idItem);  
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getItemById($id) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM item WHERE id = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getItemByIdAndProdutoId($id, $produtoId) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM item WHERE id = :id AND produtoId = :produtoId;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':produtoId', $produtoId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>
