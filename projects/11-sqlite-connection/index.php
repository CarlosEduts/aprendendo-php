<?php

// Criando tabela
try {
    $pdo = new PDO('sqlite:blog.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criando tabela
    $pdo->exec("CREATE TABLE IF NOT EXISTS posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL UNIQUE,
        content TEXT NOT NULL
    )");
} catch (PDOException $e) {
    echo "Erro ao criar base de dados:" . $e->getMessage();
}

// Função para ober a conexão PDO
function getDBConnection()
{
    $dbPath = 'blog.sqlite';
    try {
        $pdo = new PDO('sqlite:' . $dbPath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro de conexão: " . $e->getMessage());
    }
}

// Criando post
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!isset($title) and !isset($content)) {
        echo "Todos os campos são obrigatórios!";
        return;
    }

    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->execute([$title, $content]);
        echo "Postagem Feita";
    } catch (PDOException $e) {
        echo "Erro ao criar post:" . $e->getMessage();
    }
}

// Receber posts
$pdo = getDBConnection();
$data = $pdo->query("select * FROM posts");
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Creator</title>
    <!-- Não recomendado para produção, más como aqui é só um conceito funciona tranquilamente -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

</head>

<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg bg-white shadow-xl rounded-lg p-6 space-y-6">
            <h1 class="text-3xl font-semibold text-center text-gray-800">Criar Post</h1>
            <form method="POST" class="space-y-4">
                <input type="text" name="title" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Título do Post">
                <input type="text" name="content" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Conteúdo do Post">
                <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">Criar Post</button>
            </form>

            <div class="mt-8 space-y-6">
                <?php
                while ($post = $data->fetch()) {
                    echo "<div class='border-b pb-4'>";
                    echo "<h2 class='text-xl font-semibold text-gray-800'>" . $post['title'] . "</h2>";
                    echo "<p class='text-gray-600'>" . $post['content'] . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>