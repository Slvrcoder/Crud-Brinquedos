<?php
include "../infra/conexao.php";
include "../infra/funcoes.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirecionarComMensagem("../index.php", "erro", "Requisição inválida.");
}

$id = $_POST["id"] ?? "";

if ($id === "" || !ctype_digit((string) $id)) {
    redirecionarComMensagem("../index.php", "erro", "Brinquedo inválido.");
}

// Validação dos dados recebidos
$erros = validarBrinquedo($_POST);

if (!empty($erros)) {
    redirecionarComMensagem("editar.php?id=" . urlencode($id), "erro", implode(" ", $erros));
}

$nome = trim($_POST["nome"]);
$categoria = trim($_POST["categoria"]);
$faixa_etaria = trim($_POST["faixa_etaria"]);
$preco = (float) $_POST["preco"];
$quantidade_estoque = (int) $_POST["quantidade_estoque"];

// Atualiza com Prepared Statement
$sql = "UPDATE brinquedos SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade_estoque = ? WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);

if (!$stmt) {
    redirecionarComMensagem("../index.php", "erro", "Erro ao preparar a atualização: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "sssdii", $nome, $categoria, $faixa_etaria, $preco, $quantidade_estoque, $id);

if (mysqli_stmt_execute($stmt)) {
    redirecionarComMensagem("../index.php", "sucesso", "Brinquedo atualizado com sucesso!");
} else {
    redirecionarComMensagem("../index.php", "erro", "Erro ao atualizar o brinquedo: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
