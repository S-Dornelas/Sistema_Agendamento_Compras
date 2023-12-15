<h1 class="display-4">Lista de Consumo</h1>

<div class="mb-3">
    <button type="button" onclick="gerarPDF()" class="btn btn-primary">PDF</button>
</div>

<div class="mb-3">
    <?php
    $sql = "SELECT * 
    FROM consumo cs
    right JOIN itens_consumo ic ON cs.cod_consumo = ic.id_consumo            
    inner JOIN produtos p ON p.cod_produto = ic.id_produto            
    ORDER BY nomeProduto ASC";

    $resultado = $banco->query($sql);
    $qtd = $resultado->num_rows;

    if ($qtd > 0) {
        echo "<p>Foi encontrado <b>$qtd</b> resultado(s).</p>";
        echo "<table class='table table-hover table-striped table-bordered'>";
        echo "<tr>";
        echo "<th>Produto</th>";
        echo "<th>Ultimo Consumo</th>";
        echo "<th>Consumo</th>";
        echo "</tr>";

        while ($row = $resultado->fetch_object()) {
            echo "<tr>";
            echo "<td>$row->nomeProduto</td>";
            echo "<td>$row->dataConsumo</td>";
            echo "<td>$row->consumoDia</td>";
            echo "</tr>";
        }
    } else {
        echo "<p class='alert alert-danger'>Não foram encontrados resultados!</p>";
    }
    ?>
</div>


<script>
    function gerarPDF() {
        let resposta = confirm("Você deseja gerar um PDF?");

        if (resposta) {
            location.href = 'pdf-consumo.php';
        } else {
            alert("PDF não gerado.");
        }
    }
</script>