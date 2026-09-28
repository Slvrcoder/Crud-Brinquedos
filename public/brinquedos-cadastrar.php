<?php

include "../../infra/conexao.php";

$nome = $_POST["nome-prato"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];
$id_usuario = $_POST["id_usuario"];

$query = "INSERT INTO prato(nome, descricao, preco, categoria, id_usuario) 
VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $query);

mysqli_stmt_bind_param($stmt, "ssdsi", $nome, $descricao, $preco, $categoria, $id_usuario);

mysqli_stmt_execute($stmt);

header("Location: ../../index.php");
exit();

?>