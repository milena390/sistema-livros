 Sistema de Login e Cadastro
1 Introdução
Nome do Projeto: Sistema de Login e Cadastro

Descrição: Aplicação web que permite o cadastro e login de usuários com armazenamento de dados em banco MySQL.

Tecnologias Utilizadas: PHP (com PDO), MySQL, CSS, HTML.

Autor: Júlia Carla do Carmo Júlio, Paula Maria da Rocha Celidorio

Data de início: 23/06/2025

2 Estrutura do Projeto
Login/
│
├── config/
│   └── Database.php           # Classe de conexão PDO com o banco de dados
│
├── models/
│   ├── Usuario.php            # Modelo da entidade Usuário
│   └── UsuarioDAO.php         # Objeto de acesso a dados do usuário
│
├── public/
│   ├── cadastrar_usuario.php   # Lógica de cadastro do usuário
│   └── process_login.php      # Lógica de login do usuário
│
├── utils/
│   └── Sanitizacao.php        # Classe utilitária para sanitização de dados
│
└── README.md

3 Configuração do Ambiente
Requisitos
Servidor Apache ou Nginx com suporte PHP

VisualStudio Code 1.76.2

PHP 8.2

MySQL 8.0.36

XAMPP (ambiente local)

Instalação
Configure o Banco de Dados:

Crie um banco chamado login no MySQL.

Execute o seguinte SQL para criar a tabela:

sql

CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(45) NOT NULL UNIQUE,
    senha_hash VARCHAR(450) NOT NULL,

);
Configure o acesso ao banco:

No arquivo config/Database.php, ajuste as credenciais se necessário:


private $host = 'localhost';
private $db_name = 'login';
private $username = 'root';
private $password = '&tec77@info!';
Execute o servidor PHP:



4 Estrutura do Banco de Dados
sql

CREATE TABLE usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha_hash VARCHAR(255) NOT NULL,

);

5 Segurança e Boas Práticas
Uso de PDO com prepared statements (proteção contra SQL Injection)

Senhas criptografadas com password_hash()

Validação e sanitização dos dados com a classe Sanitizacao


6 Testes
Testes manuais:

Cadastro de usuário

Login com credenciais corretas

Redirecionamento após login bem-sucedido

