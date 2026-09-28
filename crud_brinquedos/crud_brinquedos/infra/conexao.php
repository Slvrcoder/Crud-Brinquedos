<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "gestao_brinquedos";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>

