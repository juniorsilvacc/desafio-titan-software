<?php
    session_start();
    require 'config/conexao.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }
    
    $funcionarios = $pdo->query("
        SELECT f.*, e.nome AS empresa_nome
        FROM tbl_funcionario f
        JOIN tbl_empresa e ON f.id_empresa = e.id_empresa ORDER BY f.id_funcionario ASC
    ")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Funcionários</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="ls_funcionarios">
        <h2>Funcionários</h2>

        <div class="btn_back_func">
            <a href="pdf/gerar_pdf.php" target="_blank">Exportar para PDF</a>
            <a href="dashboard.php">Voltar para o Dashboard</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Email</th>
                    <th>Empresa</th>
                    <th>Data Cadastro</th>
                    <th>Salário</th>
                    <th>Bonificação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($funcionarios as $func): 
                    // Calcular a diferença de tempo desde o cadastro
                    $dataCadastro = new DateTime($func['data_cadastro']);
                    $hoje = new DateTime();
                    $diferenca = $dataCadastro->diff($hoje);

                    // Determinar a classe CSS e bonificação
                    $classe = '';
                    $bonificacao = 0;

                    if ($diferenca->y > 5) {
                        $bonificacao = $func['salario'] * 0.2;
                        $classe = 'vermelho';
                    } elseif ($diferenca->y > 1) {
                        $bonificacao = $func['salario'] * 0.1;
                        $classe = 'azul';
                    }
                ?>
                <tr class="<?= $classe ?>">
                    <td><?= htmlspecialchars($func['nome']) ?></td>
                    <td><?= htmlspecialchars($func['cpf']) ?></td>
                    <td><?= htmlspecialchars($func['rg']) ?></td>
                    <td><?= htmlspecialchars($func['email']) ?></td>
                    <td><?= htmlspecialchars($func['empresa_nome']) ?></td>
                    <td><?= date('d/m/Y', strtotime($func['data_cadastro'])) ?></td>
                    <td>R$ <?= number_format($func['salario'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($bonificacao, 2, ',', '.') ?></td>
                    <td>
                        <a href="editar_funcionario.php?id=<?= $func['id_funcionario'] ?>" class="btn_edit">Editar</a>
                        <a href="excluir_funcionario.php?id=<?= $func['id_funcionario'] ?>" onclick="return confirm('Tem certeza?')" class="btn_excluir">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
