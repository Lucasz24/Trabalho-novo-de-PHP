<?php
    require_once './models/ItemModel.php';

    class ItemController {
    
        public function getItens() {
            $itemModel = new ItemModel();
            $itens = $itemModel->getItens();

            return json_encode([
                'error' => null,
                'result' => $itens
            ]);
        }
        
        public function buscarItem() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id'])) {
                return $this->mostrarErro('Você deve informar o ID do item!');
            }

            $itemModel = new ItemModel();
            $item = $itemModel->getItem($dados['id']);

            if (!$item) {
                return $this->mostrarErro('Item não encontrado!');
            }

            return json_encode([
                'error' => null,
                'result' => $item
            ]);
        }

        public function createItem() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id_usuarioItem']) || !is_numeric($dados['id_usuarioItem'])) {
                return $this->mostrarErro('Você deve informar um ID de usuário válido para o item!');
            }

           

            $item = new ItemModel(
                null,  
                $dados['id_usuarioItem']
            );

            if ($item->create()) {
                return json_encode([
                    'error' => null,
                    'result' => 'Item criado com sucesso!'
                ]);
            } else {
                return $this->mostrarErro('Erro ao criar o item!');
            }
        }

        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }
?>
