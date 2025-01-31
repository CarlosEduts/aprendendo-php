<?php
session_start(); // Inicia a sessão

$message = "";

function startData()
{
    $_SESSION["board"] = [
        ["", "", ""],
        ["", "", ""],
        ["", "", ""]
    ];
    $_SESSION['turn'] = "x";
    $_SESSION['number_of_games'] = 0;
}

// Inicializa o tabuleiro e turno na sessão, se ainda não estiverem definidos
if (!isset($_SESSION['board'])) {
    startData();
}

function verify($x, $y)
{
    if ($_SESSION["board"][$x][$y] == $_SESSION['turn']) {
        return true;
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $x = $_POST["cellX"];
    $y = $_POST["cellY"];

    if ($_POST["restart"]) {
        startData();
    }



    // Verifica se a célula está vazia antes de marcar
    if ($_SESSION['board'][$x][$y] == "") {
        $_SESSION['board'][$x][$y] = $_SESSION['turn'];
        $_SESSION['number_of_games'] = $_SESSION['number_of_games'] + 1;

        // Maneiras de ganhar
        // x x x    # # #   # # #   x # #   # x #    # # x   # # x   x # #
        // # # #    x x x   # # #   x # #   # x #    # # x   # x #   # x #
        // # # #    # # #   x x x   x # #   # x #    # # x   x # #   # # x

        if (verify(0, 0) && verify(1, 0) && verify(2, 0)) {
            $message = $_SESSION['turn'];
        } elseif (verify(0, 1) && verify(1, 1) && verify(2, 1)) {
            $message = $_SESSION['turn'];
        } elseif (verify(0, 2) && verify(1, 2) && verify(2, 2)) {
            $message = $_SESSION['turn'];
        } else if (verify(0, 0) && verify(0, 1) && verify(0, 2)) {
            $message = $_SESSION['turn'];
        } elseif (verify(1, 0) && verify(1, 1) && verify(1, 2)) {
            $message = $_SESSION['turn'];
        } elseif (verify(2, 0) && verify(2, 1) && verify(2, 2)) {
            $message = $_SESSION['turn'];
        } else if (verify(2, 0) && verify(1, 1) && verify(0, 2)) {
            $message = $_SESSION['turn'];
        } elseif (verify(0, 0) && verify(1, 1) && verify(2, 2)) {
            $message = $_SESSION['turn'];
        } elseif ($_SESSION['number_of_games'] >= 9) {
            $message = "Empate!";
        }

        // Alterna o turno
        $_SESSION['turn'] = $_SESSION['turn'] == "x" ? "o" : "x";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe Game</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            text-align: center;
        }

        .title {
            margin-bottom: 20px;
        }

        .title > h2 {
            font-size: 2rem;
            padding: 1rem;
        }

        .game-board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            background-color:rgba(51, 51, 51, 0.22);
            padding: 10px;
            border-radius: 10px;
        }

        button {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .restart-btn {
            width: fit-content;
            height: fit-content;
            margin-top: 10px;
            padding: 12px 24px;
            font-size: 1rem;
            background-color: rgb(10, 154, 0);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .winner-data {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="title">
        <h1>Tic Tac Toe</h1>
        <h2><?= $_SESSION['turn']; ?></h2>
    </div>

    <div class="game-board">
        <?php for ($y = 0; $y < 3; $y++): ?>
            <?php for ($x = 0; $x < 3; $x++): ?>
                <form method="POST">
                    <input type="hidden" name="cellX" value="<?= $x; ?>">
                    <input type="hidden" name="cellY" value="<?= $y; ?>">
                    <button type="submit"><?= $_SESSION['board'][$x][$y]; ?></button>
                </form>
            <?php endfor; ?>
        <?php endfor; ?>
    </div>

    <div class="winner-data">
        <h1><?= $message ? $message : "" ?></h1>
        <h3><?= $message ? "Ganhou!" : "" ?></h3>
        <form method="POST">
            <?= $message ? '<button class="restart-btn" type="submit" name="restart" value="restart">Reiniciar</button>' : "" ?>
        </form>
    </div>
</body>

</html>