<?php
// classes/Livro.php
class Livro {
    private $id;
    private $titulo;
    private $autor;
    private $ano;   // formato DATE
    private $isbn;

    // ID opcional (para quando é novo livro)
    public function __construct($isbn, $titulo, $autor, $ano, $id = null) {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getAutor() { return $this->autor; }
    public function getAno() { return $this->ano; }
    public function getIsbn() { return $this->isbn; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setAutor($autor) { $this->autor = $autor; }
    public function setAno($ano) { $this->ano = $ano; }
    public function setIsbn($isbn) { $this->isbn = $isbn; }
}
?>
