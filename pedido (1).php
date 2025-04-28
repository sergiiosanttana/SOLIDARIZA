<?php
// Conexão com o banco de dados
include 'conexao.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $usuario_id = $_SESSION['user_id'];

    $sql = "INSERT INTO pedidos (usuario_id, descricao) VALUES ('$usuario_id', '$descricao')";
    if (mysqli_query($conn, $sql)) {
        echo "Pedido registrado com sucesso!";
    } else {
        echo "Erro ao fazer pedido: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Pedido - Solidariza</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Fazer Pedido</h1>
    </header>

    <section>
        <form method="POST">
            <label for="descricao">Descrição do Pedido:</label><br>
            <textarea id="descricao" name="descricao" rows="5" required></textarea><br><br>

            <button type="submit">Fazer Pedido</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 Solidariza</p>
    </footer>
</body>
</html>
