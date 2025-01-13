<?php
    session_start();
    require '../config/conexao.php';

    $erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : null;
    $sucesso = isset($_SESSION['sucesso']) ? $_SESSION['sucesso'] : null;

    unset($_SESSION['erro']);
    unset($_SESSION['sucesso']);

    // Verifica se o ID do funcionário foi passado
    if (!isset($_GET['id'])) {
        header('Location: dashboard.php');
        exit;
    }

    $id = $_GET['id'];

    // Busca os dados do funcionário
    $stmt = $pdo->prepare("SELECT * FROM tbl_funcionario WHERE id_funcionario = :id");
    $stmt->execute(['id' => $id]);
    $funcionario = $stmt->fetch();

    if (!$funcionario) {
        header('Location: dashboard.php');
        exit;
    }

    // Busca as empresas para o dropdown
    $empresas = $pdo->query("SELECT * FROM tbl_empresa")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="form-wrapper">
        <form method="POST" action="../controllers/editar_funcionario_action.php" class="form-container">
            <div>
                <a href="dashboard.php" class="btn-back">
                    Voltar para o Dashboard
                </a>
            </div>

            <h2>Editar Funcionário</h2>

            <?php if ($erro): ?>
                <p class="error"><?php echo $erro; ?></p>
            <?php endif; ?>

            <?php if ($sucesso): ?>
                <p class="success"><?php echo $sucesso; ?></p>
            <?php endif; ?>
            
            <input type="hidden" name="id" value="<?= $funcionario['id_funcionario'] ?>">

            <div class="form-group">
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($funcionario['nome']) ?>" placeholder="Nome" required>
            </div>
            <div class="form-group">
                <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($funcionario['cpf']) ?>" placeholder="CPF" required>
            </div>
            <div class="form-group">
                <input type="text" id="rg" name="rg" value="<?= htmlspecialchars($funcionario['rg']) ?>" placeholder="RG" required>
            </div>
            <div class="form-group">
                <input type="text" id="email" name="email" value="<?= htmlspecialchars($funcionario['email']) ?>" placeholder="Email" required>
            </div>
            <div class="form-group">
                <select id="id_empresa" name="id_empresa" required>
                    <?php foreach ($empresas as $empresa): ?>
                        <option value="<?= $empresa['id_empresa'] ?>" <?= $empresa['id_empresa'] == $funcionario['id_empresa'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($empresa['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="salario" name="salario" value="<?= htmlspecialchars($funcionario['salario']) ?>" placeholder="Salário" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html>
