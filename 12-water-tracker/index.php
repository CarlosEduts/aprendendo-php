<?php

// Criação do banco de dados SQLite
try {
    $pdo = new PDO('sqlite:water_tracker.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criardo tabela de usuários
    $pdo->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )');

    // Criando a tabela de registros
    $pdo->exec('CREATE TABLE IF NOT EXISTS water (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        quantity INTEGER NOT NULL,
        user_id INTEGER NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )');

    echo "Base de dados criado com sucesso </br>";
} catch (PDOException $e) {
    echo "Erro ao criar base de dados: " . $e->getMessage();
}

// Função para obter a conexão PDO
function getDBConnection()
{
    $bdPath = 'water_tracker.sqlite';

    try {
        $pdo = new PDO('sqlite:' . $bdPath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        die('Erro de conexão: ' . $e->getMessage());
    }
}

// Cadastrar Usuário
function registerUser($username, $password)
{
    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);

        echo "Usuário criado com sucesso!";
    } catch (PDOException $e) {
        echo 'Erro ao criar usuário: ' . $e->getMessage();
    }
}

// Entar com o usário
session_start();
function loginUser($username, $password)
{
    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];

            echo "Logado com sucesso!";
        } else {
            echo "Usuário ou senha incorreto!";
        }
    } catch (PDOException $e) {
        echo "Erro de login: " . $e->getMessage();
    }
}

// Requisições do usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] == 'register') {
        registerUser($_POST['username'], $_POST['password']);
    } else if ($_POST['type'] == 'login') {
        loginUser($_POST['username'], $_POST['password']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <!-- Não recomendado para produção, más como aqui é só um conceito funciona tranquilamente -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="flex items-center justify-center flex-col min-h-screen bg-gray-100 text-center">
    <div class="w-full max-w-md space-y-8 p-6 bg-white shadow-lg rounded-xl">
        <h2 class="text-2xl font-bold text-center text-gray-700">Cadastro</h2>
        <form method="POST" class="space-y-4">
            <input type="hidden" name="type" value="register">
            <input type="text" name="username" id="username" required placeholder="Usuário" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            <input type="password" name="password" id="password" required placeholder="Senha" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Cadastrar</button>
        </form>

        <h2 class="text-2xl font-bold text-center text-gray-700">Entrar</h2>
        <h3 class="text-center text-gray-500">Logado Como: <?php echo $_SESSION['user_name'] ?></h3>
        <form method="POST" class="space-y-4">
            <input type="hidden" name="type" value="login">
            <input type="text" name="username" id="login-username" required placeholder="Usuário" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            <input type="password" name="password" id="login-password" required placeholder="Senha" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">Login</button>
        </form>
    </div>
</body>

</html>