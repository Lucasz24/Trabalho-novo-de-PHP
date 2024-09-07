<?php
    require_once 'Conexao.php';

    class UsuarioDAO {
        public function getUsuarios() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO usuario VALUES (:id, :nome, :cpf, :senha);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':nome', $usuario->nome);
            $stmt->bindValue(':cpf', $usuario->cpf);
            $stmt->bindValue(':senha', $usuario->senha);

            return $stmt->execute();
        }

        public function updateUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE usuario SET id = :id, nome = :nome, cpf = :cpf, senha = :senha WHERE idUsuario = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $usuario->id);
            $stmt->bindValue(':nome', $usuario->nome);
            $stmt->bindValue(':cpf', $usuario->cpf);
            $stmt->bindValue(':senha', $usuario->senha);

            return $stmt->execute();
        }

        public function deleteUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM usuario WHERE idUsuario = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $usuario->id);

            return $stmt->execute();
        }

        public function getUsuario($idUsuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario WHERE id = :idUsuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getUsuarioByNome($nome) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario WHERE nome = :nome;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getUsuarioByNomeAndSenha($nome, $senha) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario WHERE emailUsuario = :nome AND senhaUsuario = :senha;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }
?>