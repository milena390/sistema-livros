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
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Bem-Sucedido</title>
    <style>
        body {
            background-color: #FFD1DC;
            font-family: Arial, sans-serif;
            text-align: center;
            color: #8B4513;
        }
        .container {
            margin-top: 50px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            background-color: #FFEEF0;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
        }
        p {
            font-size: 20px;
        }
        button {
            background-color: #FFB6C1;
            border: none;
            color: #8B4513;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 10px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
        }
        button:hover {
            background-color: #FFA6B6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Bem-Sucedido!</h2>
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>! 🎉</p>
        <p>Aproveite sua experiência no Mundo dos Doces.</p>
        <form action="index.php" method="get">
            <button type="submit">Ir para a página inicial</button>
        </form>
    </div>
</body>
</html>
