<?php
require 'login_action.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <form method="POST" onsubmit="return validarLogin()">
        <h2>Login</h2>

        <?php if ($erro): ?>
            <p style="color:red;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <input type="email" name="email" id="email" placeholder="E-mail">
        <input type="password" name="senha" id="senha" placeholder="Senha">

        <p id="erro_msg" style="color:red;"></p>

        <button type="submit">Entrar</button>


    </form>

    <script src="assets/js/validacoes.js"></script>
</body>
</html>
