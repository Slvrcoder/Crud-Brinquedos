<?php

include "../infra/conexao.php";

$id = $_GET["id"];

$stmt = mysqli_prepare(
    $conexao,

    "SELECT * FROM brinquedos WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$brinquedos =mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brinquedos</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>Brinquedos</h1>
    </header>
    <main>

<div>
            <h2>Editando o brinquedo!</h2>
            <form action="public/brinquedos-editar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $brinquedos["id"]?>">

                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?php echo $brinquedos["nome"]?>">
                <br>
                <label for="descricao">Descrição:</label>
                <input type="text" name="descricao" value="<?php echo $brinquedos["descricao"]?>">>
                <br>
                <label for="preco">Preço:</label>
                <input type="number" name="preco" value="<?php echo $brinquedos["preco"]?>" step="0.01" min="0">
                <br>
                <label for="categoria">Categoria:</label>
                <input type="text" name="categoria" value="<?php echo $brinquedos["categoria"]?>">
                <br>

                <button type="submit">Atualizar</button>
            </form>
        </div>

</main>

</body>

</html>