<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "solidariza";

// Criando a conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Checando a conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
