<?php
include "infra/conexao.php";

// Busca todos os brinquedos cadastrados (prepared statement)
$sql = "SELECT id, nome, categoria, faixa_etaria, preco, quantidade_estoque FROM brinquedos ORDER BY id DESC";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Mensagem de sucesso/erro vinda de outra página (cadastrar, atualizar, excluir)
$mensagem = $_GET["mensagem"] ?? "";
$tipo = $_GET["tipo"] ?? "";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Brinquedos</title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <header>
        <h1>Gestão de Brinquedos</h1>
    </header>

    <main>
        <?php if ($mensagem): ?>
            <div class="alerta alerta-<?php echo htmlspecialchars($tipo); ?>">
                <?php echo htmlspecialchars($mensagem); ?>
            </div>
        <?php endif; ?>

        <h2>Cadastrar novo brinquedo</h2>
        <form action="public/cadastrar.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" maxlength="100" required>
            <br>

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" maxlength="60" required>
            <br>

            <label for="faixa_etaria">Faixa Etária:</label>
            <input type="text" id="faixa_etaria" name="faixa_etaria" placeholder="Ex: 3-6 anos" maxlength="30" required>
            <br>

            <label for="preco">Preço (R$):</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" required>
            <br>

            <label for="quantidade_estoque">Quantidade em Estoque:</label>
            <input type="number" id="quantidade_estoque" name="quantidade_estoque" min="0" required>
            <br>

            <button type="submit">Cadastrar</button>
        </form>

        <div>
            <h2>Brinquedos Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Faixa Etária</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
                <?php if (mysqli_num_rows($resultado) === 0): ?>
                    <tr>
                        <td colspan="7">Nenhum brinquedo cadastrado.</td>
                    </tr>
                <?php endif; ?>
                <?php while ($brinquedo = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $brinquedo["id"]; ?></td>
                        <td><?php echo htmlspecialchars($brinquedo["nome"]); ?></td>
                        <td><?php echo htmlspecialchars($brinquedo["categoria"]); ?></td>
                        <td><?php echo htmlspecialchars($brinquedo["faixa_etaria"]); ?></td>
                        <td>R$ <?php echo number_format($brinquedo["preco"], 2, ",", "."); ?></td>
                        <td><?php echo $brinquedo["quantidade_estoque"]; ?></td>
                        <td>
                            <a href="public/editar.php?id=<?php echo $brinquedo["id"]; ?>">Editar</a>
                            <a href="public/excluir.php?id=<?php echo $brinquedo["id"]; ?>"
                               onclick="return confirm('Tem certeza que deseja excluir este brinquedo?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>

    <footer>
        <p>Sistema de Gestão de Brinquedos &copy; <?php echo date("Y"); ?></p>
    </footer>
</body>
</html>
<?php
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>
