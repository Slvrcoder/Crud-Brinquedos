<?php

include"../../infra/conexao.php";
$id = $_GET["id"];

$stmt = mysqli_prepare(
    $conexao,

    "DELETE FROM brinquedos WHERE id = ? "

);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

header("Location: ../index.php");
?>