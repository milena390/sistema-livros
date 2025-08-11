<?php
require_once __DIR__ . '/Livro.php';
require_once __DIR__ . '/../config/Database.php';

class LivroRepository {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Adicionar livro
    public function adicionar(Livro $livro) {
        $sql = "INSERT INTO tbl_livros (isbn, titulo, autor, ano)
                VALUES (:isbn, :titulo, :autor, :ano)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':isbn'   => $livro->getIsbn(),
            ':titulo' => $livro->getTitulo(),
            ':autor'  => $livro->getAutor(),
            ':ano'    => $livro->getAno()
        ]);
    }

    // Listar todos
    public function listar() {
        $sql = "SELECT * FROM tbl_livros ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Editar livro
    public function editar($id, Livro $livro) {
        $sql = "UPDATE tbl_livros 
                   SET isbn = :isbn, titulo = :titulo, autor = :autor, ano = :ano
                 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':isbn'   => $livro->getIsbn(),
            ':titulo' => $livro->getTitulo(),
            ':autor'  => $livro->getAutor(),
            ':ano'    => $livro->getAno(),
            ':id'     => $id
        ]);
    }

    // Excluir livro
    public function excluir($id) {
        $sql = "DELETE FROM tbl_livros WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
