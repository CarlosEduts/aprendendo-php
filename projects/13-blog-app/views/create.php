<?php 

include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO posts (title, category, content) VALUES (?, ?, ?)");
        $stmt->execute([$title, $category, $content]);
        echo "Post criado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao criar post: " . $e->getMessage();
    }
}

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

        <main class="py-24 px-6 flex items-center justify-center">
            <?= $twig->render('new_post.twig.html') ?>
        </main>
    </div>
</body>

</html>