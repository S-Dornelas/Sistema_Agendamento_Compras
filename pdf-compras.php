<?php
include("banco/banco.php");
include("./ezpdf/class.ezpdf.php");

error_reporting(E_ALL & ~E_NOTICE);

function calcularTotal(array $data) {
    $totalValores = array_sum(array_column($data, 'Valor'));
    $totalQuantidade = array_sum(array_column($data, 'Quantidade Comprada'));

    foreach ($data as &$linha) {
        $porcentagem = ($linha['Valor'] / $totalValores) * 100;
        $linha['Porcentagem'] = number_format($porcentagem, 2) . '%';
    }

    $linhaTotal = array(
        'Fornecedor' => 'Total: ',
        'Quantidade Comprada' => $totalQuantidade,    
        'Valor' => number_format($totalValores, 2),
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
$qtd = $resultadoConsulta->num_rows;

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
        'Ultima Compra' => $row['ultimaCompra']
    );
    $data[] = $linha;
}

$resultado = calcularTotal($data);

$columns = array(
    'Fornecedor' => 'Fornecedor',
    'Produto' => 'Produto',
    'Quantidade Comprada' => 'Quantidade Comprada',
    'Ultima Compra' => 'Ultima Compra',
    'Valor' => 'Valor R$',
    'Porcentagem' => 'Porcentagem'
);

$pdf = new Cezpdf("a4", 'landscape');
$pdf->selectFont('./ezpdf/fonts/Helvetica');
$pdf->setPreferences('utf-8', 1);
$pdf->ezTable($resultado, $columns, 'Relatorio de Compras', array('width' => 550));
$pdf->ezStream();

