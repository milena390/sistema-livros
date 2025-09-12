<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca PM</title>
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
            max-width: 640px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 32px 28px;
            box-shadow: 0 8px 24px var(--shadow);
        }

        .logo {
            width: 150px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 16px var(--shadow);
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            margin: 8px 0 10px;
            color: var(--text);
        }

        p {
            margin: 0 0 12px;
            color: var(--muted);
        }

        .buttons {
            margin-top: 24px;
        }

        button {
            background-color: var(--btn);
            border: 1px solid var(--border);
            color: var(--text);
            padding: 14px 28px;
            font-size: 18px;
            cursor: pointer;
            margin: 10px;
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
            h1 { font-size: 28px; }
            button {
                width: 100%;
                max-width: 320px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logotipo -->
        <img src="livro.jpg" alt="Logo da Biblioteca PJ" class="logo">

        <h1>Bem-vindo à biblioteca PM!</h1>
        <p>Faça seu login ou cadastro para explorar nosso mundo literário</p>

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
