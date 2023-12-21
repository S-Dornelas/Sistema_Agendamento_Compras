<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    include("banco/banco.php");

    $sql = "SELECT * 
FROM itens_consumo ic
INNER JOIN consumo cs ON cs.cod_consumo = ic.id_consumo
RIGHT JOIN produtos p ON p.cod_produto = ic.id_produto
INNER JOIN itens_compras i ON p.cod_produto = i.id_produto
INNER JOIN compras c ON c.cod_compras = i.id_compras";

    $resultado = $banco->query($sql);
    $qtd = $resultado->num_rows;

    $labels = array();
    $dados = array();

    $tipoGrafico = isset($_GET['tipo']) ? $_GET['tipo'] : 'bar';

    if ($qtd > 0) {
        while ($row = $resultado->fetch_object()) {
            $fornecedor = $row->fornecedor;
            $nomeproduto = $row->nomeProduto;
            $qtd_compras = $row->qtd_compras;
            $ultimaCompra = $row->ultimaCompra;
            $valor = $row->valor;

            $labels[] = $nomeproduto;
            $dados[] = $valor;
        }
    }
    ?>

    <canvas id="graficoCompras" width="400" height="300"></canvas>

    <script>
        var labels = <?php echo json_encode($labels); ?>;
        var dados = <?php echo json_encode($dados); ?>;

        var contexto = document.getElementById('graficoCompras').getContext('2d');

        paletaCores = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(260, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(230, 159, 64, 0.7)',
        ];

        corFundo = paletaCores;
        corBorda = corFundo.map(function(cor) {
            return cor.replace('0.7', '1'); // Ajuste a opacidade para a borda
        });

        var graficoCompras = new Chart(contexto, {
            type: '<?php echo $tipoGrafico; ?>',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Valores',
                    data: dados,
                    backgroundColor: corFundo,
                    borderColor: corBorda,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
