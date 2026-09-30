<?php
require_once "infra/conexao.php";

$sql = "SELECT * FROM brinquedos";
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <main>

        <div>
            <h2>Adicione um novo Brinquedo!</h2>
            <form action="public/brinquedos-cadastrar.php" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" name="nome-brinquedo">
                <br>
                <label for="descricao">Descrição:</label>
                <input type="text" name="descricao">
                <br>
                <label for="preco">Preço:</label>
                <input type="number" name="preco" step="0.01" min="0">
                <br>
                <label for="categoria">Categoria:</label>
                <input type="text" name="categoria">
                <br>
                <label for="faixa_etaria">Faixa etária:</label>
                <input type="text" name="faixa_etaria">
                <br>

                <button type="submit">Cadastrar</button>
            </form>
        </div>

        <div>
            <h2>Brinquedos Cadastrados</h2>
            <table border="1">
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Faixa Etária</th>
                </tr>

                <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $linha["nome"] ?></td>
                        <td><?php echo $linha["descricao"] ?></td>
                        <td><?php echo $linha["preco"] ?></td>
                        <td><?php echo $linha["categoria"] ?></td>
                        <td><?php echo $linha["faixa_etaria"] ?></td>
                        <td>
                            <a href="public/brinquedos-editar.php? id=<?php echo $linha["id"] ?>">Editar</a>
                            <a href="public/brinquedos-excluir.php? id=<?php echo $linha["id"] ?>" onclick="return confirm('Tem certeza que deseja excluir este brinquedo?')">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>

                

            </table>
        </div>
    </main>
</body>
</html>