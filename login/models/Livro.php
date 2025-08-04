<?php
// classes/Livro.php
class Livro {
    private $titulo;
    private $autor;
    private $ano;
    private $isbn;

    public function __construct($titulo, $autor, $ano, $isbn) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
        $this->isbn = $isbn;
    }

    // Métodos getters e setters
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
