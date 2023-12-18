<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <button type="button" onclick="gerarDocumento()" class="btn btn-primary">Gerar Relatório</button>
</div>

<script>
    function gerarDocumento() {
        Swal.fire({
            title: 'Você deseja gerar um Relatório?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deseja gerar em PDF ou Excel?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'PDF',
                    cancelButtonText: 'Excel'
                }).then((relatorio) => {
                    if (relatorio.isConfirmed) {
                        Swal.fire({
                            title: 'Deseja alterar valores da planilha Compras temporariamente?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Sim',
                            cancelButtonText: 'Não'
                        }).then((alterarPdf) => {
                            if (alterarPdf.isConfirmed) {
                                location.href = '?page=comprar-editar';
                            } else {
                                location.href = 'pdf-compras.php';
                            }
                        });
                    } else {
                        location.href = 'xls-compras.php';
                    }
                });
            } else {
                alert("Relatório não gerado.");
            }
        });
    }
</script>