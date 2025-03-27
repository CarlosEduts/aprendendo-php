<?php

// Página dedicada a posts únicos selecionados por id

include '../includes/config.php';

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

// Capturar post atraves do ID na URL
$postID = '';
if (preg_match('/^\/post\/(\d+)$/', $request, $matches)) {
    $postID = (int) $matches[1];
}

if (empty($postID)) {
    die('ID não encontrado');
}

// Conexão com banco de dados para receber post atravez do id
$pdo = getDbConnection();
$stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
$stmt->execute([$postID]);
$post = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
        $stmt->execute([(int) $_POST['delete']]);
        require 'views/home.php';
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App feito com PHP</title>

    <!-- Não recomendado para produção, más como aqui é só um conceito funciona tranquilamente -->
    <script src="https://unpkg.com/@tailwindcss/browser@4" defer></script>
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <div class="bg-gray-50 dark:bg-gray-800">
        <?= $twig->render('nav.twig.html') ?>

        <div class="py-24 px-6 flex flex-wrap items-center justify-center">

            <main class="w-full max-w-2xl">
                <h1 class="text-2xl font-bold mb-3 text-gray-500 dark:text-gray-400""><?= $post['title'] ?></h1>
                <p class=" mb-3 text-gray-500 dark:text-gray-400"><?= $post['content'] ?></p>
                    <form method="POST">
                        <input type="hidden" name="delete" value="<?= $post['id'] ?>">
                        <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Excluir</button>
                    </form>
            </main>
        </div>
    </div>
</body>

</html>