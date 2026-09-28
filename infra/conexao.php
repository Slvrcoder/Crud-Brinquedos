<?php

$host = "localhost:6608";
$usuario = "root";
$senha = "";
$banco = "brinquedos";
$porta = 6608;

$conexao = new mysqli($host, $usuario, $senha, $banco, $porta);

if ($conexao->connect_error) {
    die("Erro na conexão com o banco: " . $conexao->connect_error);
};

$conexao->set_charset("utf8mb4");