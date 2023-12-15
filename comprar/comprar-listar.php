<h1 class="display-4">Lista de Compras</h1>

<div class="mb-3">
    <?php
    $sql = "SELECT * 
    FROM  itens_consumo ic
    INNER JOIN consumo cs ON cs.cod_consumo = ic.id_consumo
    RIGHT JOIN produtos p ON p.cod_produto = ic.id_produto
    INNER JOIN itens_compras i ON p.cod_produto = i.id_produto
    INNER JOIN compras c ON c.cod_compras = i.id_compras
    ORDER BY nomeProduto ASC";

    $resultado = $banco->query($sql);
    $qtd = $resultado->num_rows;

    if ($qtd > 0) {
        echo "<p>Foi encontrado <b>$qtd</b> resultado(s).</p>";
        echo "<table class='table table-hover table-striped table-bordered'>";
        echo "<tr>";
        echo "<th>Fornecedor</th>";
        echo "<th>Produto</th>";
        echo "<th>Quantidade Compradas</th>";
        echo "<th>Ultima Compra</th>";
        echo "<th>Valor R$</th>";
        echo "</tr>";

        while ($row = $resultado->fetch_object()) {
            $fornecedor = $row->fornecedor;
            $nomeproduto = $row->nomeProduto;
            $qtd_compras = $row->qtd_compras;
            $ultimaCompra = $row->ultimaCompra;
            $valor = $row->valor;

            echo "<tr>";
            echo "<td>$row->fornecedor</td>";
            echo "<td>$row->nomeProduto</td>";
            echo "<td>$row->qtd_compras</td>";
            echo "<td>$row->ultimaCompra</td>";
            echo "<td>" . number_format($row->valor, 2, ',', '.') . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<p class='alert alert-danger'>Não foram encontrados resultados!</p>";
    }
    ?>
</div>

<div class="mb-3">
    <button type="button" onclick="gerarPDF()" class="btn btn-primary">PDF</button>
</div>

<script>
    
    function gerarPDF() {
        let resposta = confirm("Você deseja gerar um PDF?");

        if (resposta) {
            let alterarPdf = confirm("Deseja alterar valores da planilha Compras?");

            if (alterarPdf) {
                location.href = '?page=comprar-editar';
            } else {
                location.href = 'pdf-compras.php';
            }
        } else {
            alert("PDF não gerado.");
        }
    }
</script>
