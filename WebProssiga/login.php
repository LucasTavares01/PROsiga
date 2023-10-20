<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="login.php">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required><br>
        
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required><br>
        
        <input type="submit" value="Entrar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Conecte-se ao banco de dados (substitua as informações de conexão)
        $host = "seu_host";
        $username = "seu_usuario";
        $password = "sua_senha";
        $database = "Professores";

        $connection = new mysqli($host, $username, $password, $database);

        if ($connection->connect_error) {
            die("Erro na conexão com o banco de dados: " . $connection->connect_error);
        }

        // Receba os dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['password'];

        // Consulta ao banco de dados
        $query = "SELECT * FROM professores WHERE email = '$email' AND senha = '$senha'";
        $result = $connection->query($query);

        if ($result->num_rows == 1) {
            // Login bem-sucedido
            echo "Login bem-sucedido. Você pode redirecionar para a página desejada.";
        } else {
            // Login falhou
            echo "Login falhou. Verifique suas credenciais.";
        }

        // Feche a conexão com o banco de dados
        $connection->close();
    }
    ?>
</body>
</html>
