<?php
    require_once 'Conexao.php';

    class ProdutoDAO {
        public function getProdutos() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM produto;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createProduto(ProdutoModel $produto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO produto (nome, descricao, preco) VALUES (:nome, :descricao, :preco);";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':nome', $produto->nome);
            $stmt->bindValue(':descricao', $produto->descricao);
            $stmt->bindValue(':preco', $produto->preco);

            return $stmt->execute();
        }

        public function updateProduto(ProdutoModel $produto) {
            $conexao = (new Conexao())->getConexao();

           
            $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $produto->id);
            $stmt->bindValue(':nome', $produto->nome);
            $stmt->bindValue(':descricao', $produto->descricao);
            $stmt->bindValue(':preco', $produto->preco);

            return $stmt->execute();
        }

        public function deleteProduto(ProdutoModel $produto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM produto WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $produto->id);

            return $stmt->execute();
        }

        public function getProduto($idProduto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM produto WHERE id = :id;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idProduto);  
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getProdutoByNome($nome) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM produto WHERE nome = :nome;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getProdutoByNomeAndDescricao($nome, $descricao) {
            $conexao = (new Conexao())->getConexao();

            
            $sql = "SELECT * FROM produto WHERE nome = :nome AND descricao = :descricao;";  

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);  
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>
