<?php
include "../infra/conexao.php";
include "../infra/funcoes.php";

// Só aceita requisições via POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirecionarComMensagem("../index.php", "erro", "Requisição inválida.");
}

// Validação dos dados recebidos
$erros = validarBrinquedo($_POST);

if (!empty($erros)) {
    redirecionarComMensagem("../index.php", "erro", implode(" ", $erros));
}

$nome = trim($_POST["nome"]);
$categoria = trim($_POST["categoria"]);
$faixa_etaria = trim($_POST["faixa_etaria"]);
$preco = (float) $_POST["preco"];
$quantidade_estoque = (int) $_POST["quantidade_estoque"];

// Insere com Prepared Statement
$sql = "INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade_estoque) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexao, $sql);

if (!$stmt) {
    redirecionarComMensagem("../index.php", "erro", "Erro ao preparar o cadastro: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "sssdi", $nome, $categoria, $faixa_etaria, $preco, $quantidade_estoque);

if (mysqli_stmt_execute($stmt)) {
    redirecionarComMensagem("../index.php", "sucesso", "Brinquedo cadastrado com sucesso!");
} else {
    redirecionarComMensagem("../index.php", "erro", "Erro ao cadastrar o brinquedo: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
