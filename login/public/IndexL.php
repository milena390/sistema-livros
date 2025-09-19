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
  /* Paleta aconchegante em bege e cinza */
  :root {
    --bg: #F5F1E8;          /* fundo bege claro */
    --card: #FAF7F0;        /* cartão ligeiramente mais claro */
    --text: #4E4A46;        /* cinza quente escuro */
    --muted: #6B655E;       /* cinza médio para subtítulos */
    --border: #D2C6B8;      /* bege acinzentado */
    --btn: #EDE3D4;         /* bege do botão */
    --btn-hover: #D9CBB8;   /* bege mais escuro no hover */
    --shadow: rgba(34, 30, 24, 0.12);
    --shadow-strong: rgba(34, 30, 24, 0.18);
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px;
    line-height: 1.5;
  }

  .container {
    background-color: var(--card);
    padding: 40px;
    border-radius: 20px;
    width: 100%;
    max-width: 800px;
    box-shadow: 0 8px 24px var(--shadow);
    border: 1px solid var(--border);
  }

  h1, h2 {
    color: var(--text);
    text-align: center;
    margin-bottom: 20px;
  }

  .mensagem {
    text-align: center;
    margin-bottom: 20px;
    font-weight: bold;
    color: var(--muted);
    background-color: #EFE9E0; /* bege suave */
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
    color: var(--muted);
  }

  input {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background-color: #fff;
    color: var(--text);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  input:focus {
    border-color: #CDBFAE;
    outline: none;
    box-shadow: 0 0 6px rgba(205, 191, 174, 0.6);
  }

  button {
    background-color: var(--btn);
    color: var(--text);
    padding: 12px 24px;
    margin-top: 15px;
    border: 1px solid var(--border);
    border-radius: 12px;
    font-size: 16px;
    cursor: pointer;
    box-shadow: 0 4px 12px var(--shadow);
    transition: background-color 0.2s ease, transform 0.05s ease, box-shadow 0.2s ease;
  }

  button:hover {
    background-color: var(--btn-hover);
    transform: translateY(-1px);
    box-shadow: 0 8px 18px var(--shadow-strong);
  }

  ul {
    list-style: none;
    padding-left: 0;
    margin-top: 20px;
  }

  li {
    background-color: #F2EFE9; /* bege acinzentado claro */
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 10px;
    color: var(--text);
    box-shadow: 0 2px 6px var(--shadow);
  }

  li form {
    display: inline-block;
    margin-left: 10px;
  }

  .button-container {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 10px;
  }

  .button-container button {
    padding: 8px 16px;
    font-size: 14px;
    border-radius: 8px;
    cursor: pointer;
    border: 1px solid var(--border);
    background-color: var(--btn);
    color: var(--text);
    transition: background-color 0.2s ease;
  }

  .button-container button.edit {
    background-color: #E4D8C7; /* bege dourado */
  }

  .button-container button.edit:hover {
    background-color: #D1C0A8;
  }

  .button-container button.delete {
    background-color: #E0B4B4; /* bege avermelhado */
  }

  .button-container button.delete:hover {
    background-color: #CFA2A2;
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
