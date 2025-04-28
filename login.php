<?php
// Conexão com o banco de dados
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($senha, $user['senha'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header("Location: pedido.php");
    } else {
        echo "E-mail ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Solidariza</title>
    <link rel="stylesheet" href="login.css">
   
</head>
<body>
    <section>
        <header>
            <h1>Login</h1>
        </header>

        <form method="POST">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <button type="submit">Login</button>
        </form>

        <footer>
            <p>&copy; 2025 Solidariza</p>
        </footer>
    </section>
</body>
</html>

