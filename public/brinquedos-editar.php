<?php

include "../infra/conexao.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id           = $_POST["id"];
    $nome         = $_POST["nome"];
    $descricao    = $_POST["descricao"];
    $preco        = $_POST["preco"];
    $categoria    = $_POST["categoria"];
    $faixa_etaria = $_POST["faixa_etaria"];

    $stmt = mysqli_prepare(
        $conexao,
        "UPDATE brinquedos
         SET nome = ?, descricao = ?, preco = ?, categoria = ?, faixa_etaria = ?
         WHERE id = ?"
    );

    mysqli_stmt_bind_param($stmt, "ssdssi", $nome, $descricao, $preco, $categoria, $faixa_etaria, $id);
    mysqli_stmt_execute($stmt);

    header("Location: ../index.php");
    exit();
}


$id = $_GET["id"];

$stmt = mysqli_prepare($conexao, "SELECT * FROM brinquedos WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$brinquedo = mysqli_fetch_assoc($resultado);

if (!$brinquedo) {
    die("Brinquedo não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Brinquedo</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <header>
        <h1>Brinquedos</h1>
    </header>
    <main>
        <div>
            <h2>Editando o brinquedo!</h2>
            <form action="brinquedos-editar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $brinquedo["id"] ?>">

                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($brinquedo["nome"]) ?>">
                <br>
                <label for="descricao">Descrição:</label>
                <input type="text" name="descricao" value="<?php echo htmlspecialchars($brinquedo["descricao"]) ?>">
                <br>
                <label for="preco">Preço:</label>
                <input type="number" step="0.01" name="preco" value="<?php echo $brinquedo["preco"] ?>">
                <br>
                <label for="categoria">Categoria:</label>
                <input type="text" name="categoria" value="<?php echo htmlspecialchars($brinquedo["categoria"]) ?>">
                <br>
                <label for="faixa_etaria">Faixa etária:</label>
                <input type="text" name="faixa_etaria" value="<?php echo htmlspecialchars($brinquedo["faixa_etaria"]) ?>">
                <br>

                <button type="submit">Atualizar</button>
            </form>
        </div>
    </main>
</body>
</html>