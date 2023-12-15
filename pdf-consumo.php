<?php
include("banco/banco.php");
include("./ezpdf/class.ezpdf.php");

error_reporting(E_ALL & ~E_NOTICE);

$sql = "SELECT * 
FROM consumo cs
right JOIN itens_consumo ic ON cs.cod_consumo = ic.id_consumo            
inner JOIN produtos p ON p.cod_produto = ic.id_produto            
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
        'Ultimo Consumo' => $row['dataConsumo'],
        'Consumo' => $row['consumoDia']       
    );
    $data[] = $linha;
}

$columns = array(
    'Produto' => 'Produto',
    'Ultimo Consumo' => 'Ultimo Consumo',
    'Consumo' => 'Consumo'
);

$pdf = new Cezpdf("a4", 'landscape');
$pdf->selectFont('./ezpdf/fonts/Helvetica');
$pdf->setPreferences('utf-8', 1);
$pdf->ezTable($data, $columns, 'Relatorio de Compras', array('width' => 550));
$pdf->ezStream();
