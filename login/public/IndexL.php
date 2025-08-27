<?php
session_start();

// Caminho para o arquivo JSON
define('JSON_FILE', 'livros.json');

// Função para ler os dados do arquivo JSON
function lerLivros() {
    if (file_exists(JSON_FILE)) {
        $jsonData = file_get_contents(JSON_FILE);
        return json_decode($jsonData, true);
    }
    return [];
}

// Função para salvar os dados no arquivo JSON
function salvarLivros($livros) {
    $jsonData = json_encode($livros, JSON_PRETTY_PRINT);
    file_put_contents(JSON_FILE, $jsonData);
}

// Função para adicionar livro
if (isset($_POST['adicionar'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];
    $isbn = $_POST['isbn'];

    $livros = lerLivros();
    $id = count($livros) > 0 ? max(array_column($livros, 'id')) + 1 : 1; // Gerando um novo ID

    $livro = [
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'ano' => $ano,
        'isbn' => $isbn
    ];

    $livros[] = $livro;
    salvarLivros($livros);

    $_SESSION['mensagem'] = "📚 Livro cadastrado com sucesso!";
    header("Location: IndexL.php");
    exit;
}

// Função para editar livro
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];

    $livros = lerLivros();
    foreach ($livros as &$livro) {
        if ($livro['id'] == $id) {
            $livro['titulo'] = $titulo;
            $livro['autor'] = $autor;
            $livro['ano'] = $ano;
            break;
        }
    }

    salvarLivros($livros);

    $_SESSION['mensagem'] = "✏️ Livro editado com sucesso!";
    header("Location: IndexL.php");
    exit;
}

// Função para excluir livro
if (isset($_POST['excluir'])) {
    $id = $_POST['id'];
    $livros = lerLivros();
    $livros = array_filter($livros, function ($livro) use ($id) {
        return $livro['id'] != $id;
    });
    $livros = array_values($livros); // Reindexando o array

    salvarLivros($livros);

    $_SESSION['mensagem'] = "🗑️ Livro excluído com sucesso!";
    header("Location: IndexL.php");
    exit;
}

// Listar livros
$livros = lerLivros();
$mensagem = $_SESSION['mensagem'] ?? '';
unset($_SESSION['mensagem']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Livros</title>
  <style>
    /* Reset e base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa; /* cinza muito claro */
      color: #2d3748; /* cinza escuro */
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 40px;
    }

    .container {
      background-color: rgba(250, 250, 250, 0.95); /* quase branco */
      padding: 40px;
      border-radius: 20px;
      width: 100%;
      max-width: 800px;
      box-shadow: 0 0 25px rgba(45, 55, 72, 0.15); /* sombra suave cinza */
    }

    h1, h2 {
      color: #2b6cb0; /* azul médio */
      text-align: center;
      margin-bottom: 20px;
    }

    .mensagem {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: #276749; /* verde escuro */
      background-color: #c6f6d5; /* verde claro */
      padding: 10px;
      border-radius: 10px;
    }

    form {
      margin-bottom: 30px;
      text-align: left;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #a0aec0; /* cinza claro */
      background-color: #fff;
      color: #2d3748;
    }

    input:focus {
      border-color: #2b6cb0; /* azul médio */
      outline: none;
      box-shadow: 0 0 5px #2b6cb0aa;
    }

    button {
      background-color: #3182ce; /* azul vibrante */
      color: white;
      padding: 10px 20px;
      margin-top: 15px;
      border: none;
      border-radius: 30px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #2c5282; /* azul escuro */
    }

    ul {
      list-style: none;
      padding-left: 0;
    }

    li {
      background-color: #edf2f7; /* cinza claro */
      padding: 15px;
      margin-bottom: 10px;
      border-radius: 10px;
      color: #2d3748;
    }

    li form {
      display: inline-block;
      margin-left: 10px;
    }

    .button-container {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .button-container button {
      padding: 8px 16px;
      font-size: 14px;
      border-radius: 30px;
      cursor: pointer;
      border: none;
      color: white;
      transition: opacity 0.3s ease;
    }

    .button-container button.edit {
      background-color: #d69e2e; /* amarelo dourado */
    }

    .button-container button.edit:hover {
      background-color: #b7791f; /* amarelo escuro */
    }

    .button-container button.delete {
      background-color: #e53e3e; /* vermelho */
    }

    .button-container button.delete:hover {
      background-color: #9b2c2c; /* vermelho escuro */
    }

    .button-container button:hover {
      opacity: 0.8;
    }

    @media (max-width: 600px) {
      .container {
        padding: 20px;
      }

      button {
        width: 100%;
      }

      .button-container {
        flex-direction: column;
      }

      .button-container button {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Cadastro de Livros</h1>

    <?php if ($mensagem): ?>
      <div class="mensagem"><?= $mensagem ?></div>
    <?php endif; ?>

    <form action="IndexL.php" method="POST">
      <label for="titulo">Título:</label>
      <input type="text" name="titulo" id="titulo" required>

      <label for="autor">Autor:</label>
      <input type="text" name="autor" id="autor" required>

      <label for="ano">Ano:</label>
      <input type="number" name="ano" id="ano" required>

      <label for="isbn">ISBN:</label>
      <input type="text" name="isbn" id="isbn" required>

      <button type="submit" name="adicionar">Adicionar Livro</button>
    </form>

    <h2>Lista de Livros</h2>
    <ul>
        <?php foreach ($livros as $livro): ?>
            <li>
                <div class="livro-info">
                    <h3><?= htmlspecialchars($livro['titulo']) ?> - <?= htmlspecialchars($livro['autor']) ?></h3>
                    <p>Ano: <?= $livro['ano'] ?> | ISBN: <?= $livro['isbn'] ?> | ID: <?= $livro['id'] ?></p>
                </div>

                <div class="button-container">
                    <!-- Formulário para editar -->
                    <form action="IndexL.php" method="POST">
                        <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                        <input type="text" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required>
                        <input type="text" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required>
                        <input type="number" name="ano" value="<?= $livro['ano'] ?>" required>
                        <button type="submit" name="editar" class="edit">Salvar Edição</button>
                    </form>

                    <!-- Formulário para excluir -->
                    <form action="IndexL.php" method="POST">
                        <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                        <button type="submit" name="excluir" class="delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>
