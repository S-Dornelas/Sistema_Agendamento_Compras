<h1 class="display-4">Cadastrar Consumo</h1>

<form action="?page=salvar-consumo" method="POST">
    <input type="hidden" name="acao" value="salvar">
    <input type="hidden" name="cod_produto" value="<?php echo $cod_produto; ?>">
    
    <div class="mb-3">
        <label>Selecione o Produto</label>
        <select name="nomeProduto" class="form-control" required>
            <option> - Escolha o Produto -</option>
            <?php
            $sql_produtos = "SELECT * FROM produtos";
            $result_produtos = $banco->query($sql_produtos);

            if ($result_produtos->num_rows > 0) {
                while ($row_produto = $result_produtos->fetch_assoc()) {
                    echo "<option>". $row_produto['nomeProduto'] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum produto disponível</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Quantidade Consumida</label>
        <input type="number" name="consumoDia" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Data do Consumo</label>
        <input type="date" name="dataConsumo" class="form-control" required>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success">Registrar Consumo</button>        
    </div>
</form>