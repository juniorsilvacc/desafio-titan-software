<?php
session_start();
require 'config/conexao.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Recupera as informações do usuário a partir do banco, se necessário
$stmt = $pdo->prepare("SELECT * FROM tbl_usuario WHERE id_usuario = :id_usuario");
$stmt->execute(['id_usuario' => $_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <h1>Bem-vindo, <?php echo htmlspecialchars($user['login']); ?>!</h1>

    <p>Você está logado no sistema.</p>

    <p><a href="logout_action.php">Sair</a></p>

</body>
</html>
