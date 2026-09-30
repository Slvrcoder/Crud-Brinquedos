<?php

include "../infra/conexao.php";

$nome = $_POST["nome-brinquedo"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];

$query = "INSERT INTO brinquedos(nome, descricao, preco, categoria) VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $query);

mysqli_stmt_bind_param($stmt, "ssds", $nome, $descricao, $preco, $categoria);

mysqli_stmt_execute($stmt);

header("Location: ../index.php");
exit();

?>