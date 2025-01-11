<?php
    session_start();
    
    $erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : null;
    $sucesso = isset($_SESSION['sucesso']) ? $_SESSION['sucesso'] : null;

    // Limpa as mensagens após exibição
    unset($_SESSION['erro']);
    unset($_SESSION['sucesso']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Empresa</title>
</head>
<body>
    <form method="POST" action="cadastrar_empresa_action.php">
        <h2>Cadastrar Empresa</h2>

        <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
        <?php if (isset($sucesso)) echo "<p style='color:green;'>$sucesso</p>"; ?>

        <input type="text" name="nome" placeholder="Nome da Empresa" required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
