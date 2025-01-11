<?php
    session_start();
    require 'config/conexao.php';

    $erro = null;
    $sucesso = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];

        if (empty($nome)) {
            $erro = "O campo nome é obrigatório.";
        } else {
            try {
                // Verifica se o nome da empresa já existe
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_empresa WHERE nome = :nome");
                $stmt->execute(['nome' => $nome]);
                $count = $stmt->fetchColumn();

                if ($count > 0) {
                    $erro = "Já existe uma empresa cadastrada com esse nome.";
                } else {
                    // Caso contrário, insere a nova empresa
                    $stmt = $pdo->prepare("INSERT INTO tbl_empresa (nome) VALUES (:nome)");
                    $stmt->execute(['nome' => $nome]);

                    if ($stmt->rowCount() > 0) {
                        $sucesso = "Empresa cadastrada com sucesso!";
                    } else {
                        $erro = "Erro ao cadastrar a empresa.";
                    }
                }
            } catch (PDOException $e) {
                $erro = "Erro ao cadastrar a empresa: " . $e->getMessage();
            }
        }

        $_SESSION['erro'] = $erro;
        $_SESSION['sucesso'] = $sucesso;

        header('Location: cadastrar_empresa.php');
        exit;
    }
?>
