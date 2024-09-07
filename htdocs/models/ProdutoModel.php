<?php
    require_once 'DAL/produtoDAO.php';

    class ProdutoModel {
        public ?int $id;
        public ?string $nome;
        public ?string $descricao;
        public ?float $preco;

        public function __construct(
            ?int $id = null,
            ?string $nome = null,
            ?string $descricao = null,  
            ?float $preco = null  
        ) {
            $this->id = $id;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
        }

        public function getProdutos() {
            $ProdutoDAO = new ProdutoDAO();

            $produtos = $ProdutoDAO->getProdutos();

            foreach ($produtos as &$produto) {
                $produto = new ProdutoModel(
                    $produto['id'],
                    $produto['nome'],
                    $produto['descricao'],
                    $produto['preco']
                );
            }

            return $produtos;
        }

        public function create() {
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->createProduto($this);
        }

        public function update() {
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->updateProduto($this);
        }

        public function delete() {
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->deleteProduto($this);
        }

        public function getProduto($idProduto) {
            $produtoDAO = new ProdutoDAO();

            $produto = $produtoDAO->getProduto($idProduto);

            $produto = new ProdutoModel(
                $produto['id'],
                $produto['nome'],
                $produto['descricao'],
                $produto['preco']  
            );

            return $produto;
        }
    }
?>
