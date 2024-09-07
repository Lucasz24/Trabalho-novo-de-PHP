<?php
    require_once './models/PedidoModel.php';

    class PedidoController {
    
        public function getPedidos() {
            $pedidoModel = new PedidoModel();
            $pedidos = $pedidoModel->getPedidos();

            return json_encode([
                'error' => null,
                'result' => $pedidos
            ]);
        }
        
        public function buscarPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id'])) {
                return $this->mostrarErro('Você deve informar o ID do pedido!');
            }

            $pedidoModel = new PedidoModel();
            $pedido = $pedidoModel->getPedido($dados['id']);

            if (!$pedido) {
                return $this->mostrarErro('Pedido não encontrado!');
            }

            return json_encode([
                'error' => null,
                'result' => $pedido
            ]);
        }

        
        public function createPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id_usuarioPedido']) || !is_numeric($dados['id_usuarioPedido'])) {
                return $this->mostrarErro('Você deve informar um ID de usuário válido para o pedido!');
            }


            $pedido = new PedidoModel(
                null,  
                $dados['id_usuarioPedido']  
            );

            $pedido->create();

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
