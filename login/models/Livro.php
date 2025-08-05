<?php
// classes/Livro.php
class Livro {
    private $id;
    private $titulo;
    private $autor;
    private $ano;
    private $isbn;

    public function __construct($id, $titulo, $autor, $ano, $isbn) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
        $this->isbn = $isbn;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }
}
?>
