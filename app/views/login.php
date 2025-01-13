<?php
    require '../controllers/login_action.php';

    $erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : null;

    unset($_SESSION['erro']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="form-wrapper">
        <form method="POST" onsubmit="return validarLogin()" class="form-container">
            <h2>Login</h2>

            <?php if ($erro): ?>
                <p class="error"><?php echo $erro; ?></p>
            <?php endif; ?>

            <div class="form-group">
                <input name="email" id="email" placeholder="E-mail">
            </div>

            <div class="form-group">
                <input type="password" name="senha" id="senha" placeholder="Senha">
            </div>
                
            <p id="erro_msg" style="color:red; white-space: pre-wrap;"></p>

            <div class="form-group">
                <button type="submit" class="btn-submit">Entrar</button>
            </div>
        </form>
    </div>

    <script src="../assets/js/validacoes.js"></script>
</body>
</html>
