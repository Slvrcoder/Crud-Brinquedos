<?php
include "../infra/conexao.php";
include "../infra/funcoes.php";

$id = $_GET["id"] ?? "";

if ($id === "" || !ctype_digit((string) $id)) {
    redirecionarComMensagem("../index.php", "erro", "Brinquedo inválido.");
}

// Busca o brinquedo pelo ID com Prepared Statement
$sql = "SELECT id, nome, categoria, faixa_etaria, preco, quantidade_estoque FROM brinquedos WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$brinquedo = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if (!$brinquedo) {
    redirecionarComMensagem("../index.php", "erro", "Brinquedo não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Brinquedo</title>
    <link rel="stylesheet" href="../style/styles.css">
</head>
<body>
    <header>
        <h1>Editar Brinquedo</h1>
    </header>

    <main>
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $brinquedo["id"]; ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" maxlength="100" value="<?php echo htmlspecialchars($brinquedo["nome"]); ?>" required>
            <br>

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" maxlength="60" value="<?php echo htmlspecialchars($brinquedo["categoria"]); ?>" required>
            <br>

            <label for="faixa_etaria">Faixa Etária:</label>
            <input type="text" id="faixa_etaria" name="faixa_etaria" maxlength="30" value="<?php echo htmlspecialchars($brinquedo["faixa_etaria"]); ?>" required>
            <br>

            <label for="preco">Preço (R$):</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" value="<?php echo htmlspecialchars($brinquedo["preco"]); ?>" required>
            <br>

            <label for="quantidade_estoque">Quantidade em Estoque:</label>
            <input type="number" id="quantidade_estoque" name="quantidade_estoque" min="0" value="<?php echo htmlspecialchars($brinquedo["quantidade_estoque"]); ?>" required>
            <br>

            <button type="submit">Salvar Alterações</button>
            <a href="../index.php">Cancelar</a>
        </form>
    </main>

    <footer>
        <p>Sistema de Gestão de Brinquedos &copy; <?php echo date("Y"); ?></p>
    </footer>
</body>
</html>
<?php
mysqli_close($conexao);
?>
