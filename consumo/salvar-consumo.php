<?php
switch ($_REQUEST["acao"]) {
   case 'salvar':      
      if (empty($_POST["nomeProduto"]) || empty($_POST["dataConsumo"]) || empty($_POST["consumoDia"])) {
         echo "<script>alert('Por favor, preencha todos os campos obrigatórios.');</script>";
         echo "<script>location.href='?page=consumo-listar';</script>";
         exit;
      }

      $nomeProduto = $_POST["nomeProduto"];
      $dataConsumo = $_POST["dataConsumo"];
      $consumoDia = $_POST["consumoDia"];

      $banco->begin_transaction();

      $sql1 = "INSERT INTO produtos (nomeProduto) VALUES (?)";
      $stmt1 = $banco->prepare($sql1);
      $stmt1->bind_param("s", $nomeProduto);
      $stmt1->execute();
      $cod_produto = $stmt1->insert_id;

      $sql2 = "INSERT INTO consumo (dataConsumo) VALUES (?)";
      $stmt2 = $banco->prepare($sql2);
      $stmt2->bind_param("s", $dataConsumo);
      $stmt2->execute();
      $cod_consumo = $stmt2->insert_id;

      $sql3 = "INSERT INTO itens_consumo (id_produto, id_consumo, consumoDia) VALUES (?, ?, ?)";
      $stmt3 = $banco->prepare($sql3);
      $stmt3->bind_param("iis", $cod_produto, $cod_consumo, $consumoDia);
      $stmt3->execute();

      if ($stmt1->error || $stmt2->error || $stmt3->error) {
         $banco->rollback();
         echo "<script>alert('Erro durante a transação.');</script>";
         echo "<script>location.href='?page=consumo-listar';</script>";
      } else {
         $banco->commit();
         echo "<script>alert('Cadastro realizado com sucesso!');</script>";
         echo "<script>location.href='?page=consumo-listar';</script>";
      }

      $stmt1->close();
      $stmt2->close();
      $stmt3->close();
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
