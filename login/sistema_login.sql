-- Cria o banco de dados
CREATE DATABASE sistema_login;
USE sistema_login;

-- Cria a tabela de usuários
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insere um usuário de exemplo (senha = 'senha123')
INSERT INTO usuarios (email, senha_hash) 
VALUES ('usuario@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');