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
</head>
<body>
    <form method="POST" action="cadastrar_funcionario_action.php">
        <h2>Cadastrar Funcionário</h2>

        <?php if ($erro): ?>
            <p style="color:red;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <p style="color:green;"><?php echo $sucesso; ?></p>
        <?php endif; ?>

        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="cpf" placeholder="CPF" required>
        <input type="text" name="rg" placeholder="RG">
        <input type="email" name="email" placeholder="E-mail" required>
        <select name="id_empresa" required>
            <option value="">Selecione a Empresa</option>
            <?php foreach ($empresas as $empresa): ?>
                <option value="<?= $empresa['id_empresa'] ?>"><?= $empresa['nome'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="salario" placeholder="Salário" step="0.01" required>
        
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
