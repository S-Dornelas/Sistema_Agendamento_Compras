<?php
include("banco/banco.php");
include("./ezpdf/class.ezpdf.php");


error_reporting(E_ALL & ~E_NOTICE);

$sql = "SELECT c.fornecedor, p.nomeProduto, qtd_compras, valor, ultimaCompra, cod_produto
FROM itens_compras i 
RIGHT JOIN compras c ON i.id_compras = c.cod_compras 
RIGHT JOIN produtos p ON i.id_produto = p.cod_produto
ORDER BY nomeProduto ASC";
$resultadoConsulta = $banco->query($sql);
$qtd = $resultadoConsulta->num_rows;

if (!$resultadoConsulta) {
    die("Erro na consulta: " . $banco->error);
}

$data = array();

while ($row = $resultadoConsulta->fetch_assoc()) {
    $linha = array(
        'Produto' => $row['nomeProduto'],        
        'Valor' => $row['valor']        
    );
    $data[] = $linha;
}

$totalValores = array_sum(array_column($data, 'Valor'));

foreach ($data as &$linha) {
    $porcentagem = ($linha['Valor'] / $totalValores) * 100;
    $linha['Porcentagem'] = number_format($porcentagem, 2) . '%';
}

$linhaTotal = array(
    'Produto' => 'Total: ',    
    'Valor' => number_format($totalValores, 2),
    'Porcentagem' => '100%',
);
$data[] = $linhaTotal;

$columns = array(
    'Produto' => 'Produto',
    'Valor' => 'Valor R$',
    'Porcentagem' => 'Porcentagem'
);

$pdf = new Cezpdf("a4", 'landscape');
$pdf->selectFont('./ezpdf/fonts/Helvetica');
$pdf->setPreferences('utf-8', 1);
$pdf->ezTable($data, $columns, 'Relatorio de Consumo', array('width' => 550));
$pdf->ezStream();


