<?php
include("banco/banco.php");
include("./ezpdf/class.ezpdf.php");

error_reporting(E_ALL & ~E_NOTICE);

function calcularTotal(array $data)
{
    $totalValores = array_sum(array_column($data, 'Valor'));
    $totalQuantidade = array_sum(array_column($data, 'Quantidade Comprada'));

    foreach ($data as &$linha) {
        $porcentagem = ($totalValores != 0) ? ($linha['Valor'] / $totalValores) * 100 : 0;
        $linha['Porcentagem'] = number_format($porcentagem, 2) . '%';
        $linha['Valor'] = number_format($linha['Valor'], 2, ',', '.'); 
    }

    $linhaTotal = array(
        'Fornecedor' => 'Total: ',
        'Produto' => ' ',
        'Quantidade Comprada' => $totalQuantidade,
        'Valor' => '=SOMA(D2:D'.(count($data)+1).')',
        'UltimaCompra' => ' ',
        'Porcentagem' => '100%',
    );
    $data[] = $linhaTotal;

    return $data;
}

$sql = "SELECT * 
    FROM  itens_consumo ic
    INNER JOIN consumo cs ON cs.cod_consumo = ic.id_consumo
    RIGHT JOIN produtos p ON p.cod_produto = ic.id_produto
    INNER JOIN itens_compras i ON p.cod_produto = i.id_produto
    INNER JOIN compras c ON c.cod_compras = i.id_compras
    ORDER BY nomeProduto ASC";

$resultadoConsulta = $banco->query($sql);

if (!$resultadoConsulta) {
    die("Erro na consulta: " . $banco->error);
}

$data = array();

while ($row = $resultadoConsulta->fetch_assoc()) {
    $linha = array(
        'Fornecedor' => $row['fornecedor'],
        'Produto' => $row['nomeProduto'],
        'Quantidade Comprada' => $row['qtd_compras'],
        'Valor' => $row['valor'],
        'Ultima Compra' => $row['ultimaCompra'],
    );
    $data[] = $linha;
}

$resultado = calcularTotal($data);

// Geração do XLS
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="relatorio_produtos.xls"');
header('Cache-Control: max-age=0');

echo '<table border="1">';
echo '<tr>';
foreach (array_keys($resultado[0]) as $column) {
    echo '<th>' . $column . '</th>';
}
echo '</tr>';

foreach ($resultado as $row) {
    echo '<tr>';
    foreach ($row as $key => $cell) {
        echo '<td>';
        echo $cell;
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';

