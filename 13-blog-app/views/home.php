<?php

// Página inicial do site

include '../includes/config.php';

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

    <!-- Não recomendado para produção, más como aqui é só um conceito funciona tranquilamente -->
    <script src="https://unpkg.com/@tailwindcss/browser@4" defer></script>
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <div class="bg-gray-50 dark:bg-gray-800">
        <?= $twig->render('nav.twig.html') ?>

        <div class="py-24 px-6">
        <?= $twig->render('categories.twig.html', ['categories' => $dbCategories]) ?>
        <main class=" flex flex-wrap">
            
            <?php
            while ($post = $stmt->fetch()) {
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