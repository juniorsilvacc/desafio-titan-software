<?php
    session_start();
    require 'config/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtém os dados enviados pelo formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $email = $_POST['email'];
        $id_empresa = $_POST['id_empresa'];
        $salario = $_POST['salario'];

        // Atualiza os dados no banco de dados
        $stmt = $pdo->prepare("
            UPDATE tbl_funcionario
            SET nome = :nome, cpf = :cpf, rg = :rg, email = :email, id_empresa = :id_empresa, salario = :salario
            WHERE id_funcionario = :id
        ");
        $stmt->execute([
            'nome' => $nome,
            'cpf' => $cpf,
            'rg' => $rg,
            'email' => $email,
            'id_empresa' => $id_empresa,
            'salario' => $salario,
            'id' => $id
        ]);

        header('Location: dashboard.php');
        exit;
    } else {
        header('Location: dashboard.php');
        exit;
    }
?>