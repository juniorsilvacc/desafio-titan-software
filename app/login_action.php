<?php
session_start();
require 'config/conexao.php';

$erro = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Por favor, insira um email válido.";
    } elseif (empty($senha)) {
        $erro = "Por favor, insira a senha.";
    } else {
        // Consultando o banco de dados para autenticar o usuário
        $stmt = $pdo->prepare("SELECT * FROM tbl_usuario WHERE login = :email AND senha = :senha");
        $stmt->execute(['email' => $email, 'senha' => $senha]);
        $user = $stmt->fetch();

        // Verifica se o usuário foi encontrado e se a senha corresponde
        if ($user) {
            if ($user['senha'] === $senha) { 
                $_SESSION['user_id'] = $user['id_usuario'];
                header('Location: dashboard.php');
                exit;
            }
        } else {
            $erro = "Por favor, insira email e senha.";
        }
    }
}
?>
