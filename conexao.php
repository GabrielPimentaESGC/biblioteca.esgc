<?php
$servername = "localhost"; // Nome do servidor do MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$database = "esgc_biblioteca"; // Nome do banco de dados

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
