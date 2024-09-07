<?php
    require_once 'DAL/pedidoDAO.php';

    class PedidoModel {
        public ?int $id;
        public ?string $id_usuario;

        public function __construct(
            ?int $id = null,
            ?string $id_usuario = null  
        ) {
            $this->id = $id;
            $this->id_usuario = $id_usuario;
        }

        public function getPedidos() {
            $pedidoDAO = new PedidoDAO();
            $pedidos = $pedidoDAO->getPedidos();

            $pedidoModelList = [];
            foreach ($pedidos as $pedido) {
                $pedidoModelList[] = new PedidoModel(
                    $pedido['id'],
                    $pedido['id_usuario']
                );
            }

            return $pedidoModelList;
        }

        public function create() {
            $pedidoDAO = new PedidoDAO();
            return $pedidoDAO->createPedido($this);
        }

        public function update() {
            $pedidoDAO = new PedidoDAO();
            return $pedidoDAO->updatePedido($this);
        }

        public function delete() {
            $pedidoDAO = new PedidoDAO();
            return $pedidoDAO->deletePedido($this);
        }

       
        public function getPedido($idPedido) {
            $pedidoDAO = new PedidoDAO();
            $pedido = $pedidoDAO->getPedido($idPedido);

            
            if ($pedido) {
                return new PedidoModel(
                    $pedido['id'],
                    $pedido['id_usuario']
                );
            }

            return null;  
        }
    }
?>
