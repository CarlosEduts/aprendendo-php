<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader, ['cache' => false]);

// Dados padrão
$userData = [
    "pending" => [],
    "inProgress" => [],
    "conclude" => []
];

// Salvar dados do usuário no cookie do navegador
function saveUserData(&$userData)
{
    setcookie('user_data', json_encode($userData), time() + (30 * 24 * 60 * 60), "/");
}

// Verificar se há dados salvo no cookie
if (isset($_COOKIE['user_data'])) {
    $userData = json_decode($_COOKIE['user_data'], true);
} else {
    saveUserData($userData);
}

// Transitar tarefas entre os estados
function moveTask($id, $from, $to, &$userData)
{
    foreach ($userData[$from] as $key => $task) {
        if ($task['id'] == $id) {
            $userData[$to][] = $task;
            unset($userData[$from][$key]);
            $userData[$from] = array_values($userData[$from]);
            saveUserData($userData);
            return;
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $type = $_POST['type'] ?? '';
    $id = $_POST['id'] ?? null;

    if ($action == 'add-task') {
        $newTask = [
            "id" => (string) rand(1, 100000),
            "title" => $_POST['title'],
            "subtile" => $_POST['subtitle'],
        ];

        $userData[$type][] = $newTask;
        saveUserData($userData);
    }

    if ($action == 'delete') {
        $userData[$type] = array_values(array_filter($userData[$type], function ($task) use ($id) {
            return $task["id"] !== $id;
        }));
        saveUserData($userData);
    } elseif ($action == 'to-right') {

        if ($type == 'pending') {
            moveTask($id, 'pending', 'inProgress', $userData);
        } elseif ($type == 'inProgress') {
            moveTask($id, 'inProgress', 'conclude', $userData);
        }
    } elseif ($action = 'to-left') {

        if ($type == 'inProgress') {
            moveTask($id, 'inProgress', 'pending', $userData);
        } elseif ($type == 'conclude') {
            moveTask($id, 'conclude', 'inProgress', $userData);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/styles/index.css">
</head>

<body>

    <div class="container">
        <div>
            <div class="pending-container">
                <div>
                    <h2>Pendente</h2>
                </div>

                <?php foreach ($userData["pending"] as $card): ?>
                    <?php echo $twig->render('card.twig.html', ['id' => $card['id'], 'type' => 'pending', 'title' => $card['title'], 'subtitle' => $card['subtile']]); ?>
                <?php endforeach; ?>
            </div>

            <div class="add-task">
                <div>
                    <h3>Adicionar tarefa</h3>
                </div>

                <form method="POST">
                    <input type="hidden" name="action" value="add-task">
                    <label for="form-title">Título</label>
                    <input type="text" name="title" id="form-title">

                    <label for="form-subtitle">Subtítulo</label>
                    <input type="text" name="subtitle" id="form-subtitle">

                    <label for="form-type">Estado</label>
                    <select name="type" id="form-type">
                        <option value="pending" default>Pendente</option>
                        <option value="inProgress">Em Progresso</option>
                        <option value="conclude">Concluído</option>
                    </select>

                    <button type="submit">Criar Tarefa</button>
                </form>
            </div>
        </div>

        <div class="in-progress-container">
            <div>
                <h2>Em progresso</h2>
            </div>
            <?php foreach ($userData["inProgress"] as $card): ?>
                <?php echo $twig->render('card.twig.html', ['id' => $card['id'], 'type' => 'inProgress', 'title' => $card['title'], 'subtitle' => $card['subtile']]); ?>
            <?php endforeach; ?>
        </div>

        <div class="conclude-container">
            <div>
                <h2>Concluído</h2>
            </div>
            <?php foreach ($userData["conclude"] as $card): ?>
                <?php echo $twig->render('card.twig.html', ['id' => $card['id'], 'type' => 'conclude', 'title' => $card['title'], 'subtitle' => $card['subtile']]); ?>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>