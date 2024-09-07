<?php
    require_once './models/UsuarioModel.php';

    class UsuarioController {
        public function getUsuarios() {
            $usuarioModel = new UsuarioModel();

            $usuarios = $usuarioModel->getUsuarios();

            return json_encode([
                'error' => null,
                'result' => $usuarios
            ]);
        }

        public function BuscarUsuarios() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o ID do usuário!');

            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($dados['id']);

            if (!$usuario)
                return $this->mostrarErro('Usuário não encontrado!');

            return json_encode([
                'error' => null,
                'result' => $usuario
            ]);
        }

        public function createUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['nomeUsuario']))
                return $this->mostrarErro('Você deve informar o nome do usuário!');

            if (empty($dados['CPFUsuario']))
                return $this->mostrarErro('Você deve informar o CPF do usuário!');
            
            if (empty($dados['senhaUsuario']))
                return $this->mostrarErro('Você deve informar a senha do usuário!');

           
            $usuario = new UsuarioModel(
                null,
                $dados['nomeUsuario'],
                $dados['CPFUsuario'],
                md5($dados['senhaUsuario']) 
            );

           
            $conexao = (new Conexao)->getConexao();

            $sql = "SELECT COUNT(*) FROM usuario WHERE cpf = :cpf;";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':cpf', $usuario->cpf); 
            $stmt->execute();

  
            if ($stmt->fetchColumn() > 0) {
                return $this->mostrarErro('CPF já cadastrado!');
            }

  
            $usuario->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id'])) {
                return $this->mostrarErro('Você deve informar o ID do usuário!');
            }

            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuario($dados['id']);

            if (!$usuario) {
                return $this->mostrarErro('Usuário não encontrado!');
            }

            $usuarioModel->id = $dados['id'];
            $usuarioModel->delete();

            return json_encode([
                'error' => null,
                'result' => 'Usuário excluído com sucesso!'
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
