<?php
    session_start();
    require 'config/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['erro'] = "Por favor, insira um email válido.";
        } elseif (empty($senha)) {
            $_SESSION['erro'] = "Por favor, insira a senha.";
        } else {
            // Consultando o banco de dados para autenticar o usuário
            $stmt = $pdo->prepare("SELECT * FROM tbl_usuario WHERE login = :email AND senha = :senha");
            $stmt->execute(['email' => $email, 'senha' => $senha]);
            $user = $stmt->fetch();

            if ($user) {
                if ($user['senha'] === $senha) { 
                    $_SESSION['user_id'] = $user['id_usuario'];
                    header('Location: dashboard.php');
                    exit;
                } else {
                    $_SESSION['erro'] = "Senha incorreta.";
                    header('Location: login.php');
                    exit;
                }
            } else {
                $_SESSION['erro'] = "Email e/ou senha incorreto.";
                header('Location: login.php');
                exit;
            }
            
        }
    }
?>
