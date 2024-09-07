<?php
    require_once 'DAL/itemDAO.php';

    class ItemModel {
        public ?int $id;
        public ?int $pedidoId;
        public ?int $produtoId;
        public ?int $quantidade;

        public function __construct(
            ?int $id = null,
            ?int $pedidoId = null,
            ?int $produtoId = null,
            ?int $quantidade = null
        ) {
            $this->id = $id;
            $this->pedidoId = $pedidoId;
            $this->produtoId = $produtoId;  
            $this->quantidade = $quantidade;
        }

        public function getItens() {
            $itemDAO = new ItemDAO();
            $itens = $itemDAO->getItens();  

            $itemModelList = [];
            foreach ($itens as $item) {
                $itemModelList[] = new ItemModel(
                    $item['id'],
                    $item['pedidoId'],
                    $item['produtoId'],
                    $item['quantidade']
                );
            }

            return $itemModelList;
        }

        public function create() {
            $itemDAO = new ItemDAO();
            return $itemDAO->createItem($this);
        }

        public function update() {
            $itemDAO = new ItemDAO();
            return $itemDAO->updateItem($this);
        }

        public function delete() {
            $itemDAO = new ItemDAO();
            return $itemDAO->deleteItem($this);
        }

        public function getItem($idItem) {
            $itemDAO = new ItemDAO();  
            $item = $itemDAO->getItem($idItem);

            if ($item) {
                return new ItemModel(
                    $item['id'],
                    $item['pedidoId'],
                    $item['produtoId'],
                    $item['quantidade']
                );
            }

            return null;  
        }
    }
?>
