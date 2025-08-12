<?php
session_start();

require_once  '../models/UsuarioDAO.php';
require_once  '../utils/Sanitizacao.php';

$nome = Sanitizacao::sanitizar($_POST['nome']);
$email = Sanitizacao::sanitizar($_POST['email']);
$senha = Sanitizacao::sanitizar($_POST['senha']);

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->criarUsuario ($nome, $email, $senha);

if ($usuario) {
    $_SESSION['mensagem'] = "Usuário criado com sucesso! :)";
} else {
    $_SESSION['mensagem'] = "Erro ao criar usuário :(. Esse email ou nome pode já estar sendo utilizado.";
}

header("Location: cadastrar.php");
exit();
?>
