<h1 class="display-4">Editar Produto</h1>
<?php 
    $sql = "SELECT * FROM produtos WHERE cod_produto=".$_REQUEST['cod_produto'];
    $res = $banco->query($sql);
    $row = $res->fetch_object();
?>

<form action="?page=salvar" method="post">
    <input type="hidden" name="acao" value="atualizar">
    <input type="hidden" name="cod_produto" value="<?php echo $row->cod_produto; ?>">    

    <div class="mb-3">
        <label>Nome do Produto</label>
        <input type="text" name="nomeProduto" class="form-control" value="<?php echo $row->nomeProduto; ?>">
    </div>

    <div class="mb-3">
        <label>Posologia</label>
        <input type="text" name="posologia" class="form-control" value="<?php echo $row->posologia; ?>">
    </div>

    <div class="mb-3">
        <label>Quantidade do Produto</label>
        <input type="text" name="unidade" class="form-control" value="<?php echo $row->unidade; ?>">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Salvar</button>    
        <button type="button" onclick="location.href='?page=produto-listar'" class="btn btn-secondary">Voltar</button>
    </div>
</form>