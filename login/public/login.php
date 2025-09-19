<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        margin: 8px 0 18px;
        color: var(--text);
    }

    label {
        font-size: 18px;
        display: block;
        margin: 10px 0 6px;
        color: var(--muted);
        text-align: left;
    }

    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 18px;
        border-radius: 8px;
        border: 1px solid var(--border);
        font-size: 16px;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    input:focus {
        border-color: #CDBFAE;
        box-shadow: 0 0 6px rgba(205, 191, 174, 0.6);
    }

    button {
        background-color: var(--btn);
        border: 1px solid var(--border);
        color: var(--text);
        padding: 14px 28px;
        font-size: 18px;
        cursor: pointer;
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
        <h2>Login</h2>
        <form action="../controller/process_login.php" method="POST">
            <label>Email:</label><br>
            <input type="email" name="email" required><br>

            <label>Senha:</label><br>
            <input type="password" name="senha" required><br>

            <button name="submit" type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>