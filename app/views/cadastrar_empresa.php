<?php
    session_start();
    
    $erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : null;
    $sucesso = isset($_SESSION['sucesso']) ? $_SESSION['sucesso'] : null;

    unset($_SESSION['erro']);
    unset($_SESSION['sucesso']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Empresa</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="form-wrapper">
        <form method="POST" action="../controllers/cadastrar_empresa_action.php" class="form-container">
            <div>
                <a href="dashboard.php" class="btn-back">
                    Voltar para o Dashboard
                </a>
            </div>

            <h2>Cadastrar Empresa</h2>

            <?php if ($erro): ?>
                <p class="error"><?php echo $erro; ?></p>
            <?php endif; ?>

            <?php if ($sucesso): ?>
                <p class="success"><?php echo $sucesso; ?></p>
            <?php endif; ?>

            <div class="form-group">
                <input type="text" name="nome" placeholder="Nome da Empresa" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn-submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>
