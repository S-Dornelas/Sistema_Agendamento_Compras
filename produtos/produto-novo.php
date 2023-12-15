<h1 class="display-4">Novo Produto</h1>

<form action="?page=salvar" method="POST">
    <input type="hidden" name="acao" value="salvar">

    <div class="mb-3">
        <label>Nome do Produto</label>
        <input type="text" name="nomeProduto" class="form-control" placeholder="Digite o nome do produto">
    </div>

    <div class="mb-3">
        <label>Posologia</label>
        <textarea class="form-control" name="posologia" rows="3" placeholder="Digite posologia do produto"></textarea>
    </div>

    <div class="mb-3">
        <label>Quantidade do Produto</label>
        <input type="text" name="unidade" class="form-control" placeholder="Digite quantidade do produto">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success">Salvar</button>    
        <button type="button" onclick="location.href='?page=produto-listar'" class="btn btn-secondary">Voltar</button>
    </div>
    
</form>