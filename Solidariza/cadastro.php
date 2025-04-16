<?php
// Conexão com o banco de dados
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitização de entradas
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido!");
    }

    // Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Query segura usando prepared statements
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $nome, $email, $senhaHash);
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Cadastro realizado com sucesso!</p>";
        } else {
            echo "<p>Erro ao cadastrar: " . mysqli_error($conn) . "</p>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Erro na preparação da query: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Solidariza</title>
    <link rel="stylesheet" href="cadastro.css">
 
</head>
<body>
    <!-- Barra Lateral -->
    <aside class="sidebar">
        <nav>
            <ul>
                <li><a href="cadastro.php">Cadastro</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="sobre.php">Sobre Nós</a></li>
                <li><a href="faq.php">FAQ</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main>
        <section>
            <h2>Cadastro</h2>
            <form method="POST">
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Solidariza</p>
    </footer>
</body>
</html>
