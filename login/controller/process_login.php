<?php
session_start();

require_once __DIR__ . '/../models/UsuarioDAO.php';
require_once __DIR__ .  '/../utils/Sanitizacao.php';

// Sanitiza as entradas
$email = Sanitizacao::sanitizar($_POST['email']);
$senha = Sanitizacao::sanitizar($_POST['senha']);

// Valida o login
$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->validarLogin($email, $senha);

if ($usuario) {
    $_SESSION['logado'] = true;
    $_SESSION['usuario_id'] = $usuario->getId();
    $_SESSION['nome_usuario'] = $usuario->getNome(); // Obtendo o nome do usuário
}else{
    $_SESSION['nome_usuario'] = 'ERRO';
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Bem-Sucedido</title>
    <style>
    /* Paleta aconchegante em cinza e bege */
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
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background-color: var(--bg);
        font-family: Arial, sans-serif;
        color: var(--text);
        text-align: center;
        line-height: 1.5;
    }

    .container {
        margin: 56px auto;
        max-width: 400px;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 32px 28px;
        box-shadow: 0 8px 24px var(--shadow);
    }

    h2 {
        font-size: 28px;
        font-weight: bold;
        margin: 8px 0 10px;
        color: var(--text);
    }

    p {
        margin: 0 0 12px;
        font-size: 18px;
        color: var(--muted);
    }

    button {
        background-color: var(--btn);
        border: 1px solid var(--border);
        color: var(--text);
        padding: 14px 28px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px var(--shadow);
        transition: background-color 0.2s ease, transform 0.05s ease, box-shadow 0.2s ease;
    }

    button:hover {
        background-color: var(--btn-hover);
        transform: translateY(-1px);
        box-shadow: 0 8px 18px var(--shadow-strong);
    }

    button:active {
        transform: translateY(0);
        box-shadow: 0 4px 10px var(--shadow);
    }

    button:focus {
        outline: 3px solid #CDBFAE;
        outline-offset: 2px;
    }

    @media (max-width: 480px) {
        .container {
            margin: 24px 16px;
            padding: 24px 18px;
        }
        h2 { font-size: 24px; }
        button {
            width: 100%;
            max-width: 320px;
        }
    }
</style>

</head>
<body>
    <div class="container">
        <h2>Login Bem-Sucedido!</h2>
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?></p>
        <p>Aproveite sua experiência no Mundo literário</p>
        <form action="../public/IndexL.php" method="get">
            <button type="submit">Cadastrar livro</button>
        </form>
    </div>
</body>
</html>
