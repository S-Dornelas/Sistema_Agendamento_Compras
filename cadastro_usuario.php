<?php
session_start();

include_once "banco/cadastro.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO cadastro (nome, senha) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $nome, $senha);

    if ($stmt->execute()) {
        // Usuário cadastrado com sucesso
        header("Location: login.php");
        exit;
    } else {
        $error = "Erro ao cadastrar usuário: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <h1>Cadastrar Usuário</h1>
    <form action="cadastro_usuario.php" method="post">
        <div>
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Digite o seu nome" required>
        </div>

        <div>
            <label>Senha</label>
            <input type="password" name="senha" placeholder="Digite a sua senha" required>
        </div>

        <input type="submit" value="Cadastrar">
    </form>

    <br>
    <a href="login.php">Já tem uma conta? Faça login aqui.</a>

</body>

</html>
