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
    /* Estilos CSS permanecem os mesmos */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('foto2.jpg');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 40px;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 20px;
      width: 100%;
      max-width: 800px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
    }

    h1, h2 {
      color: #cc9aa2;
      text-align: center;
      margin-bottom: 20px;
    }

    .mensagem {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: #4CAF50;
      background-color: #e6ffe6;
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
      border: 1px solid #ccc;
    }

    button {
      background-color: #ffc0cb;
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
      background-color: #8f5863;
    }

    ul {
      list-style: none;
      padding-left: 0;
    }

    li {
      background-color: #f9f9f9;
      padding: 15px;
      margin-bottom: 10px;
      border-radius: 10px;
    }

    li form {
      display: inline-block;
      margin-left: 10px;
    }

    .button-container {
      display: flex;
      gap: 10px;
    }

    .button-container button {
      padding: 8px 16px;
      font-size: 14px;
      border-radius: 30px;
      cursor: pointer;
    }

    .button-container button.edit {
      background-color: #ffa500;
      color: white;
    }

    .button-container button.delete {
      background-color: #f44336;
      color: white;
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
                        <input type="hidden" name="id" value="<?= $livro['id'] ?>"> <!-- Usando ID aqui -->
                        <input type="text" name="titulo" value="<?= $livro['titulo'] ?>" required>
                        <input type="text" name="autor" value="<?= $livro['autor'] ?>" required>
                        <input type="number" name="ano" value="<?= $livro['ano'] ?>" required>
                        <button type="submit" name="editar" class="edit">Salvar Edição</button>
                    </form>

                    <!-- Formulário para excluir -->
                    <form action="IndexL.php" method="POST">
                        <input type="hidden" name="id" value="<?= $livro['id'] ?>"> <!-- Usando ID aqui -->
                        <button type="submit" name="excluir" class="delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>
