<?php
    require_once './models/ProdutoModel.php';

    class ProdutoController {
        public function getProdutos() {
            $produtoModel = new ProdutoModel(); 

            $produtos = $produtoModel->getProdutos();

            return json_encode([
                'error' => null,
                'result' => $produtos
            ]);
        }

        public function BuscarProdutos() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id'])) {
                return $this->mostrarErro('Você deve informar o ID do Produto!');
            }

            $produtoModel = new ProdutoModel();
            $produto = $produtoModel->getProduto($dados['id']);  

            if (!$produto) {
                return $this->mostrarErro('Produto não encontrado!');
            }

            return json_encode([
                'error' => null,
                'result' => $produto
            ]);
        }

        public function createProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['nomeProduto'])) {
                return $this->mostrarErro('Você deve informar o nomeProduto!');
            }

            if (empty($dados['descricaoProduto'])) {
                return $this->mostrarErro('Você deve informar o descricaoProduto!');
            }
            
            if (empty($dados['precoProduto']) || !is_numeric($dados['precoProduto'])) {
                return $this->mostrarErro('Você deve informar um precoProduto válido!');
            }

            $produto = new ProdutoModel(
                null,
                $dados['nomeProduto'],
                $dados['descricaoProduto'],  
                (float)$dados['precoProduto']  
            );

            $produto->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

       private function mostrarErro(string $mensagem) {
           return json_encode([
               'error' => $mensagem,
               'result' => null
           ]);
       }
    }
?>
