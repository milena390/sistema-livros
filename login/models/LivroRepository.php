<?php
// classes/LivroRepository.php
require_once 'Livro.php';

class LivroRepository {
    private $filePath = 'data/livros.json'; // Caminho do arquivo JSON
    private $livros = [];

    // Construtor - carrega os livros do arquivo JSON
    public function __construct() {
        if (file_exists($this->filePath)) {
            $this->livros = json_decode(file_get_contents($this->filePath), true);
        }
    }

    // Gera um ID único com base nos livros existentes
    private function gerarId() {
        if (empty($this->livros)) {
            return 1;
        }
        $ids = array_column($this->livros, 'id');
        return max($ids) + 1;
    }

    // Adiciona um livro ao arquivo JSON
    public function adicionar(Livro $livro) {
        // Define o ID se ainda não estiver definido
        if ($livro->getId() === null) {
            $livro->setId($this->gerarId());
        }

        $this->livros[] = [
            'id' => $livro->getId(),
            'titulo' => $livro->getTitulo(),
            'autor' => $livro->getAutor(),
            'ano' => $livro->getAno(),
            'isbn' => $livro->getIsbn()
        ];
        $this->salvar();
    }

    // Lista todos os livros
    public function listar() {
        return $this->livros;
    }

    // Edita um livro existente pelo ID
    public function editar($id, Livro $livroAtualizado) {
        foreach ($this->livros as &$livro) {
            if ($livro['id'] === $id) {
                $livro['titulo'] = $livroAtualizado->getTitulo();
                $livro['autor'] = $livroAtualizado->getAutor();
                $livro['ano'] = $livroAtualizado->getAno();
                $livro['isbn'] = $livroAtualizado->getIsbn();
                break;
            }
        }
        $this->salvar();
    }

    // Exclui um livro pelo ID
    public function excluir($id) {
        $this->livros = array_filter($this->livros, function($livro) use ($id) {
            return $livro['id'] !== $id;
        });
        $this->livros = array_values($this->livros); // Reindexa o array
        $this->salvar();
    }

    // Salva os livros no arquivo JSON
    private function salvar() {
        file_put_contents($this->filePath, json_encode($this->livros, JSON_PRETTY_PRINT));
    }
}
?>
