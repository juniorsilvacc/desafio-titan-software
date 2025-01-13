<?php
    include('../config/conexao.php');
    use Dompdf\Dompdf;
    require_once 'dompdf/autoload.inc.php';

    // Consulta para buscar todos funcionários no banco de dados
    $stmt = $pdo->query("SELECT f.*, e.nome AS empresa_nome FROM tbl_funcionario f JOIN tbl_empresa e ON f.id_empresa = e.id_empresa");

    $html = '<!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Funcionários</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                page-break-inside: avoid; /* Evita quebra de página dentro da tabela */
            }

            table, th, td {
                border: 1px solid #ddd;
            }

            th, td {
                padding: 8px;
                text-align: left;
                word-wrap: break-word; /* Garante que o texto dentro das células não ultrapasse as margens */
                font-size: 10px; /* Ajuste o tamanho da fonte conforme necessário */
            }

            th {
                background-color: #f2f2f2;
                color: #333;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            tr:hover {
                background-color: #f1f1f1;
            }

            td {
                font-family: Arial, sans-serif;
            }
        </style>
    </head>
    <body>';

    // Verifica se existem resultados
    if ($stmt->rowCount() > 0) {
        $html .= '<table>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Nome</th>';
        $html .= '<th>CPF</th>';
        $html .= '<th>RG</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Empresa</th>';
        $html .= '<th>Data de Cadastro</th>';
        $html .= '<th>Salário</th>';
        $html .= '<th>Bonificação</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $html .= '<tr>';
            $html .= '<td>' . $row['nome'] . '</td>';
            $html .= '<td>' . $row['cpf'] . '</td>';
            $html .= '<td>' . $row['rg'] . '</td>';
            $html .= '<td>' . $row['email'] . '</td>';
            $html .= '<td>' . $row['empresa_nome'] . '</td>';
            $html .= '<td>' . $row['data_cadastro'] . '</td>';
            $html .= '<td>' . $row['salario'] . '</td>';
            $html .= '<td>' . $row['bonificacao'] . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
    } else {
        $html .= 'Nenhum dado registrado';
    }

    $html .= '</body></html>';

    // Inicializa o Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->set_option('defaultFont', 'sans');
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream();
?>
