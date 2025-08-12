<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
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
        label {
            font-size: 18px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border-radius: 8px;
            border: 1px solid #8B4513;
            font-size: 16px;
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
        .redirect-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form action="../controller/cadastrar_usuario.php" method="POST">
            <label>Nome Completo:</label><br>
            <input type="text" name="nome" required><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br>

            <label>Senha:</label><br>
            <input type="password" name="senha" required><br>

            <button type="submit">Cadastrar</button>
        </form>

        <!-- Botão para redirecionar para a tela inicial -->
        <div class="redirect-button">
            <form action="index.php" method="get">
                <button type="submit">Voltar à Página Inicial</button>
            </form>
        </div>
    </div>
</body>
</html>
