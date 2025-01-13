<?php
    session_start();
    require 'config/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $email = $_POST['email'];
        $id_empresa = $_POST['id_empresa'];
        $salario = $_POST['salario'];

        if (empty($nome) || empty($cpf) || empty($email) || empty($id_empresa)) {
            $_SESSION['erro'] = "Todos os campos são obrigatórios.";
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO tbl_funcionario (nome, cpf, rg, email, id_empresa, salario) VALUES (:nome, :cpf, :rg, :email, :id_empresa, :salario)");
                $stmt->execute([
                    'nome' => $nome,
                    'cpf' => $cpf,
                    'rg' => $rg,
                    'email' => $email,
                    'id_empresa' => $id_empresa,
                    'salario' => $salario
                ]);

                $_SESSION['sucesso'] = "Funcionário cadastrado com sucesso!";
            } catch (PDOException $e) {
                if (strpos($e->getMessage(), '1062') !== false) {
                    $_SESSION['erro'] = "Já existe um funcionário com esse CPF.";
                } else {
                    $_SESSION['erro'] = "Erro ao cadastrar funcionário: " . $e->getMessage();
                }
            }
        }
        header('Location: cadastrar_funcionario.php');
        exit;
    }
?>
