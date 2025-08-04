Cadastro de Livros - Documentação de Uso da IA Introdução Durante o desenvolvimento do projeto de Cadastro de Livros, utilizei a Inteligência Artificial (IA) para agilizar a criação de código e ajudar na resolução de problemas técnicos. A IA forneceu respostas rápidas e precisas, permitindo que eu me concentrasse em outras partes do projeto, como ajustes na interface e melhorias gerais.

Neste documento, detalho os prompts que utilizei, como a IA me ajudou a implementar as funcionalidades e a reflexão crítica sobre o uso da IA ao longo do desenvolvimento.

Prompts Utilizados Prompt 1: Como criar uma classe PHP para armazenar informações de um livro (título, autor, ano, ISBN)? Objetivo: Criar a classe Livro com as propriedades para armazenar informações do livro.

Prompt:

"Como criar uma classe PHP para armazenar informações de um livro, como título, autor, ano e ISBN?"

Resposta da IA: A IA sugeriu uma classe Livro com as propriedades necessárias e os métodos get e set para acessar e modificar os dados.

Código sugerido:

php Copiar Editar class Livro { private $titulo; private $autor; private $ano; private $isbn;

public function __construct($titulo, $autor, $ano, $isbn) {
    $this->titulo = $titulo;
    $this->autor = $autor;
    $this->ano = $ano;
    $this->isbn = $isbn;
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
} O que foi útil:

A IA forneceu uma classe bem estruturada, com todos os métodos necessários para a manipulação dos dados dos livros.

O que precisei ajustar:

Nenhum ajuste foi necessário. O código estava completo e adequado.

Prompt 2: Como criar um repositório em PHP que armazene os livros em um arquivo JSON? Objetivo: Criar a classe LivroRepository para gerenciar os livros em um arquivo JSON.

Prompt:

"Como criar um repositório em PHP para armazenar livros em um arquivo JSON? A classe deve permitir adicionar, listar, editar e excluir livros."

Resposta da IA: A IA sugeriu uma implementação utilizando JSON para persistir os dados. A classe LivroRepository foi criada com os métodos necessários para adicionar, listar, editar e excluir livros.

Código sugerido:

php Copiar Editar class LivroRepository { private $filePath = 'data/livros.json'; private $livros = [];

public function __construct() {
    if (file_exists($this->filePath)) {
        $this->livros = json_decode(file_get_contents($this->filePath), true);
    }
}

public function adicionar(Livro $livro) {
    $this->livros[] = [
        'titulo' => $livro->getTitulo(),
        'autor' => $livro->getAutor(),
        'ano' => $livro->getAno(),
        'isbn' => $livro->getIsbn()
    ];
    $this->salvar();
}

public function listar() {
    return $this->livros;
}

public function editar($isbn, Livro $livroAtualizado) {
    foreach ($this->livros as &$livro) {
        if ($livro['isbn'] === $isbn) {
            $livro['titulo'] = $livroAtualizado->getTitulo();
            $livro['autor'] = $livroAtualizado->getAutor();
            $livro['ano'] = $livroAtualizado->getAno();
            $livro['isbn'] = $livroAtualizado->getIsbn();
            break;
        }
    }
    $this->salvar();
}

public function excluir($isbn) {
    $this->livros = array_filter($this->livros, function($livro) use ($isbn) {
        return $livro['isbn'] !== $isbn;
    });
    $this->livros = array_values($this->livros);
    $this->salvar();
}

private function salvar() {
    file_put_contents($this->filePath, json_encode($this->livros, JSON_PRETTY_PRINT));
}
} O que foi útil:

A IA forneceu uma solução prática e simples, utilizando JSON para persistência, que atendeu perfeitamente às necessidades do projeto.

O código foi direto e eficiente, sem complexidades desnecessárias.

O que precisei ajustar:

Eu apenas refinei o processo de persistência e organização dos métodos, mas a solução geral estava ótima.

Prompt 3: Como criar uma interface de usuário simples em PHP para adicionar, listar, editar e excluir livros? Objetivo: Criar a interface de usuário onde os usuários podem interagir com o sistema, adicionando, listando, editando e excluindo livros.

Prompt:

"Como criar uma interface de usuário simples em PHP para cadastrar livros, listar livros, editar e excluir livros?"

Resposta da IA: A IA sugeriu um formulário básico de HTML para cadastro de livros e uma lista de livros com opções de edição e exclusão.

Código sugerido:

php Copiar Editar

Título:
<label for="autor">Autor:</label>
<input type="text" name="autor" id="autor" required><br>

<label for="ano">Ano:</label>
<input type="number" name="ano" id="ano" required><br>

<label for="isbn">ISBN:</label>
<input type="text" name="isbn" id="isbn" required><br>

<button type="submit" name="adicionar">Adicionar Livro</button>
- () Editar Excluir
O que foi útil:
A IA sugeriu uma estrutura simples e funcional, que atendeu bem à necessidade de interação do usuário.

O que precisei ajustar:

Precisei adicionar alguns detalhes visuais e ajustes de layout para melhorar a experiência do usuário, mas a base estava excelente.

Reflexão Crítica sobre o Uso da IA O uso da IA foi essencial para acelerar o desenvolvimento do projeto. Ela me ajudou a criar rapidamente a estrutura do código, sem precisar reescrever soluções comuns do zero. A IA foi particularmente útil nas etapas de criação das classes e persistência de dados com JSON, além de me fornecer sugestões práticas para o front-end.
O que foi útil:

Geração rápida de código: A IA gerou código de maneira eficiente, permitindo que eu começasse a trabalhar imediatamente nas implementações necessárias.

Respostas claras: As sugestões da IA foram bem focadas, diretas e compatíveis com o que eu estava buscando.

O que precisei ajustar:

Interface de usuário: A IA sugeriu um layout básico, mas precisei adicionar ajustes de estilo para melhorar a experiência do usuário.

Soluções mais simples: Em alguns momentos, a IA sugeriu soluções mais complexas do que eu realmente precisava, então simplifiquei alguns aspectos.

No geral, a IA foi uma excelente aliada durante o desenvolvimento, permitindo um ganho significativo de produtividade e garantindo que o código estivesse correto e bem estruturado.
