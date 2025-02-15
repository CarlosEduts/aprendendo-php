<?php

// Página dedicada a listar postagens por categorias

include '../includes/config.php';

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

// Capturar a categoria atraves da url
$postCategory = "";
if (preg_match('/^\/categorie\/(\w+)$/', $request, $matches)) {
    $postCategory = (string) $matches[1]; // Captura o ID como string
}

if (empty($postCategory)) {
    die('Categoria não encontrada');
}

// Conexão com o PDO para receber dados de categoria
$pdo = getDbConnection();
$stmt = $pdo->prepare("SELECT * FROM posts WHERE category = ?");
$stmt->execute([$postCategory]);
$posts = $stmt->fetchAll();

// Conexão com o PDO para receber todas as categorias
$pdo = getDbConnection();
$stmt = $pdo->query("SELECT * FROM posts");
$dbCategories = $pdo->query("SELECT category FROM posts");

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App feito com PHP</title>

    <script src="https://unpkg.com/@tailwindcss/browser@4" defer></script>
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <div class="bg-gray-50 dark:bg-gray-800">
        <?= $twig->render('nav.twig.html') ?>

        <div class="py-24 px-6">
            <?= $twig->render('categories.twig.html', ['categories' => $dbCategories]) ?>
            <main class="flex flex-wrap">
                <?php
                foreach ($posts as $post) {
                    echo $twig->render(
                        'post_card.twig.html',
                        [
                            'title' => $post['title'],
                            'category' => $post['category'],
                            "content" => $post['content'],
                            'id' => $post['id']
                        ]
                    );
                }
                ?>
            </main>
        </div>
    </div>
</body>

</html>
