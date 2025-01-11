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
    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($user['login']); ?></h1>

        <h2>Dashboard</h2>
        <p>Gerencie suas empresas e funcionários.</p>

        <div class="actions">
            <div class="top-actions">
                <a href="cadastrar_empresa.php">Cadastrar Empresa</a>
                <a href="cadastrar_funcionario.php">Cadastrar Funcionário</a>
            </div>

            <div class="bottom-actions">
                <a href="listar_funcionarios.php" class="list-button">Listar Funcionários</a>
            </div>
        </div>

        <div class="logout">
            <p><a href="logout_action.php">Sair</a></p>
        </div>
    </div>
</body>
</html>
