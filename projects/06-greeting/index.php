<?php

// O codigo abaixo sauda o usuário de acordo com o horário
date_default_timezone_set('America/Bahia');
$hour = date('H');

$greeting = match (true) {
    $hour >= 1 && $hour <= 13 => "Good Day!",
    $hour >= 14 && $hour <= 18 => "Good Afternoon!",
    $hour >= 19 && $hour <= 24 => "Good Night!",
};

$gradiantColor1 = "rgb(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")";
$gradiantColor2 = "rgb(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greeting</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            background: linear-gradient(90deg,
                    <?= $gradiantColor1 ?> 0%,
                    <?= $gradiantColor2 ?> 100%);
            width: 100%;
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 1rem;
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            background-size: 200% 200%;
            animation: gradient-animation 10s infinite linear;
        }

        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;

            }

            50% {
                background-position: 100% 50%;

            }

            100% {
                background-position: 0% 50%;

            }
        }

        h1 {
            text-align: center;
            font-size: 3rem;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><?= $greeting ?></h1>
    </div>
</body>

</html>