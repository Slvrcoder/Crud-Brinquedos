<?php
include "../infra/conexao.php";
include "../infra/funcoes.php";

$id = $_GET["id"] ?? "";

if ($id === "" || !ctype_digit((string) $id)) {
    redirecionarComMensagem("../index.php", "erro", "Brinquedo inválido.");
}

// Exclui com Prepared Statement
$sql = "DELETE FROM brinquedos WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);

if (!$stmt) {
    redirecionarComMensagem("../index.php", "erro", "Erro ao preparar a exclusão: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        redirecionarComMensagem("../index.php", "sucesso", "Brinquedo excluído com sucesso!");
    } else {
        redirecionarComMensagem("../index.php", "erro", "Brinquedo não encontrado.");
    }
} else {
    redirecionarComMensagem("../index.php", "erro", "Erro ao excluir o brinquedo: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
