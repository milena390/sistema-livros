<?php

class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha_hash;
    private $created_at;

    public function __construct($dados = []) {
        if (isset($dados['id'])) $this->id = $dados['id'];
        if (isset($dados['nome'])) $this->nome = $dados['nome'];
        if (isset($dados['email'])) $this->email = $dados['email'];
        if (isset($dados['senha_hash'])) $this->senha_hash = $dados['senha_hash'];
        if (isset($dados['created_at'])) $this->created_at = $dados['created_at'];
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getEmail() { return $this->email; }
    public function getSenhaHash() { return $this->senha_hash; }
    public function getCreatedAt() { return $this->created_at; }

    // Setters
    public function setNome($nome) { $this->nome = $nome; }
    public function setEmail($email) { $this->email = $email; }
    public function setSenhaHash($senha_hash) { $this->senha_hash = $senha_hash; }
}
