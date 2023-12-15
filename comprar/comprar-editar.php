<h1 class="display-4">Alterar Valor dos Produtos</h1>

<form action="pdf-temporario.php" method="post">
    <input type="hidden" name="cod_produto" value="<?php echo $row_produto; ?>">
    <input type="hidden" name="cod_compras" value="<?php echo $row_compras; ?>">

    <div class="mb-3">
        <label>Porcentagem de Reajuste</label>
        <input type="number" name="porcentagem_alteracao" class="form-control" step="any" required>
    </div>

    <div class="mb-3">
        <button type="submit" class='btn btn-primary'>Gerar PDF Temporário</button>
    </div>
</form>