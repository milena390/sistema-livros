<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca PM</title>
    <style>
        body {
            background-color: #FFD1DC;
            font-family: Arial, sans-serif;
            text-align: center;
            color: #8B4513;
        }
        .container {
            margin-top: 50px;
        }
        .logo {
            width: 150px;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 36px;
            font-weight: bold;
        }
        .buttons {
            margin-top: 20px;
        }
        button {
            background-color: #FFB6C1;
            border: none;
            color: #8B4513;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            margin: 10px;
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
        <!-- Logotipo -->
        <img src="livro.jpg" alt="Logo da Biblioteca PJ" class="logo">

        <h1>Bem-vindo a biblioteca PM!</h1>
        <p>Faça seu login ou cadastro para explorar nossos mundo literário</p>
        <div class="buttons">
            <form action="login.php" method="get" style="display: inline;">
                <button type="submit">Login</button>
            </form>
            <form action="cadastrar.php" method="get" style="display: inline;">
                <button type="submit">Cadastro</button>
            </form>
        </div>
    </div>
</body>
</html>
