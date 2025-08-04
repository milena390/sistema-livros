<?php
session_start();

$servername = "localhost";
$database = "login";
$username = "root";
$password = "&tec77@info!";


$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, senha FROM usuario WHERE email = ?";
    $prep = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prep, "s", $email);
    mysqli_stmt_execute($prep);
    mysqli_stmt_store_result($prep);

    if (mysqli_stmt_num_rows($prep) === 1) {
        mysqli_stmt_bind_result($prep, $id, $senha_hash);
        mysqli_stmt_fetch($prep);

        if (password_verify($senha, $senha_hash)) {
            $_SESSION['usuario_id'] = $id;
            echo "Login bem-sucedido!";
        } else {
            echo "Email ou senha incorreta!";
        }
    } else {
        echo "Email ou senha incorreta!";
    }

    mysqli_stmt_close($prep);
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="">
        <label for="emai">Email: </label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="senha">Senha: </label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <button type="submit" name="entrar">entrar</button>
    </form>
</body>
</html>