<h1 class="display-4">Novo Fornecedor</h1>

<form action="?page=salvar-fornecedor" method="POST">
    <input type="hidden" name="acao" value="salvar">

    <div class="mb-3">
        <label>Nome do Fornecedor</label>
        <input type="text" name="fornecedor" class="form-control" placeholder="Digite o nome do fornecedor">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success">Salvar</button>    
        <button type="button" onclick="location.href='?page=fornecedor-listar'" class="btn btn-secondary">Voltar</button>
    </div>
    
</form>