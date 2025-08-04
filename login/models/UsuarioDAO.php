<?php
require_once 'Usuario.php';
require_once '../config/Database.php';

class UsuarioDAO {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Busca um usuário pelo  email
    public function buscarPorEmail( string $email): ?array {
        $query = "SELECT * FROM usuario WHERE  email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ?: null;
        }

        return null;
    }

    // Valida o login verificando email e senha
    public function validarLogin( string $email, string $senha): ?Usuario {
        $usuarioData = $this->buscarPorEmail($email);

        if ($usuarioData && password_verify($senha, $usuarioData['senha_hash'])) {
            return new Usuario($usuarioData);
        }

        return null;
    }

    // Cria um novo usuário no banco de dados
    public function criarUsuario(string $nome, string $email, string $senha): bool {
        $query = "INSERT INTO login.usuario (nome, email, senha_hash) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($query);

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
