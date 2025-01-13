<?php
    session_start();
    require '../config/conexao.php';

    if (!isset($_GET['id'])) {
        header('Location: ../views/dashboard.php');
        exit;
    }

    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM tbl_funcionario WHERE id_funcionario = :id");
    $stmt->execute(['id' => $id]);

    header('Location: ../views/listar_funcionarios.php');
    exit;
?>
