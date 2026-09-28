<?php

/**
 * Valida os dados de um brinquedo vindos do formulário.
 * Retorna um array com as mensagens de erro encontradas (vazio se estiver tudo ok).
 */
function validarBrinquedo($dados)
{
    $erros = [];

    $nome = trim($dados["nome"] ?? "");
    $categoria = trim($dados["categoria"] ?? "");
    $faixa_etaria = trim($dados["faixa_etaria"] ?? "");
    $preco = $dados["preco"] ?? "";
    $quantidade_estoque = $dados["quantidade_estoque"] ?? "";

    if ($nome === "") {
        $erros[] = "O nome do brinquedo é obrigatório.";
    } elseif (mb_strlen($nome) > 100) {
        $erros[] = "O nome do brinquedo deve ter no máximo 100 caracteres.";
    }

    if ($categoria === "") {
        $erros[] = "A categoria é obrigatória.";
    }

    if ($faixa_etaria === "") {
        $erros[] = "A faixa etária é obrigatória.";
    }

    if ($preco === "" || !is_numeric($preco)) {
        $erros[] = "O preço deve ser um valor numérico.";
    } elseif ((float) $preco < 0) {
        $erros[] = "O preço não pode ser negativo.";
    }

    if ($quantidade_estoque === "" || !ctype_digit((string) $quantidade_estoque)) {
        $erros[] = "A quantidade em estoque deve ser um número inteiro válido.";
    } elseif ((int) $quantidade_estoque < 0) {
        $erros[] = "A quantidade em estoque não pode ser negativa.";
    }

    return $erros;
}

/**
 * Redireciona o usuário com uma mensagem de status (sucesso ou erro) via query string.
 */
function redirecionarComMensagem($url, $tipo, $mensagem)
{
    header("Location: " . $url . "?tipo=" . urlencode($tipo) . "&mensagem=" . urlencode($mensagem));
    exit;
}
