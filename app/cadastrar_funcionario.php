<?php
    session_start();
    require 'config/conexao.php';
    
    $erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : null;
    $sucesso = isset($_SESSION['sucesso']) ? $_SESSION['sucesso'] : null;

    unset($_SESSION['erro']);
    unset($_SESSION['sucesso']);

    // Consulta as empresas para exibir no formulário
    $empresas = $pdo->query("SELECT * FROM tbl_empresa")->fetchAll(PDO::FETCH_ASSOC);   
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="form-wrapper">
        <form method="POST" action="cadastrar_funcionario_action.php" class="form-container">
            <div>
                <a href="dashboard.php" class="btn-back">
                    Voltar para o Dashboard
                </a>
            </div>

            <h2>Cadastrar Funcionário</h2>

            <?php if ($erro): ?>
                <p class="error"><?php echo $erro; ?></p>
            <?php endif; ?>

            <?php if ($sucesso): ?>
                <p class="success"><?php echo $sucesso; ?></p>
            <?php endif; ?>

            <div class="form-group">
                <input type="text" name="nome" placeholder="Nome" required>
            </div>
            <div class="form-group">
                <input type="text" name="cpf" placeholder="CPF" required>
            </div>
            <div class="form-group">
                <input type="text" name="rg" placeholder="RG">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <select name="id_empresa" required>
                    <option value="">Selecione a Empresa</option>
                    <?php foreach ($empresas as $empresa): ?>
                        <option value="<?= $empresa['id_empresa'] ?>"><?= $empresa['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="number" name="salario" placeholder="Salário" step="0.01" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Cadastrar</button>
            </div>
        </form>
    </div>

</body>
</html>
