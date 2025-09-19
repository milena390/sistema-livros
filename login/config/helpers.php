<?php
// helpers.php
require_once 'Database.php';

function syncJson($path = __DIR__ . '/livros.json') {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->query("SELECT id, isbn, titulo, autor, ano FROM tbl_livros ORDER BY titulo ASC");
    $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    file_put_contents($path, json_encode($livros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
