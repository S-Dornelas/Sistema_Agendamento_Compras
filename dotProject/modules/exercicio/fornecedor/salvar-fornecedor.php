<?php
switch ($_REQUEST["acao"]) {
   case 'salvar':
      $sql = "INSERT INTO compras (
         fornecedor)
       VALUES (
         '" . $_POST["fornecedor"] . "'               
         )";
         
      $res = $banco->query($sql);

      if ($res == true) {
         echo "<script>alert('Cadastro realizado com sucesso!');</script>";
         echo "<script>location.href='?page=fornecedor-listar';</script>";
      } else {
         echo "<script>alert('ERRO! :( ... Não foi possivel realizar o cadastro!');</script>";
         echo "<script>location.href='?page=fornecedor-listar';</script>";
      }
      break;
   case 'atualizar':
      $sql = "UPDATE compras SET fornecedor = '" . $_POST["fornecedor"] . "' WHERE cod_compras = " . $_POST["cod_compras"];

      $res = $banco->query($sql);


      if ($res == true) {
         echo "<script>alert('Cadastro editado com sucesso!');</script>";
         echo "<script>location.href='?page=fornecedor-listar';</script>";
      } else {
         echo "<script>alert('ERRO! :( ... Não foi possivel realizar a edição!');</script>";
         echo "<script>location.href='?page=fornecedor-listar';</script>";
      }
      break;
   case 'excluir':
      $sql = "DELETE FROM compras WHERE cod_compras=" . $_REQUEST["cod_compras"];

      $resposta = $banco->query($sql);

      if (!$resposta) {
         echo "<script>alert('Cadastro não excluido!');</script>";
         echo "<script> location.href='?page=fornecedor-listar';</script>";
      } else {
         echo "<script>alert('Cadastro excluido com sucesso!');</script>";
         echo "<script> location.href='?page=fornecedor-listar';</script>";
      }
      break;
}
