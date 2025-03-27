<?php

// O codigo abaixo formata a data do dia atual no seguinte exmplo (Sexta-feira 24 de Janeiro de 2025)
date_default_timezone_set('America/Bahia');
$dateNowDayOfMonth = date('d');
$dateNowDayOfWeek = date('w');
$dateNowMonth = date('n') - 1;
$dateNowYear = date('Y');

$daysOfWeekNames = [
    "Domingo",
    "Segunda-feira",
    "Terça-feira",
    "Quarta-feira",
    "Quinta-feira",
    "Sexta-feira",
    "Sábado"
];

$monthOfYearNames = [
    "Janeiro",
    "Fevereiro",
    "Março",
    "Abril",
    "Maio",
    "Junho",
    "Julho",
    "Agosto",
    "Setembro",
    "Outubro",
    "Novembro",
    "Dezembro"
];

$gradiantColor1 = "rgb(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")";
$gradiantColor2 = "rgb(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data de Hoje</title>
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

        h2 {
            opacity: 0.8;
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
        <h2><?= $daysOfWeekNames[$dateNowDayOfWeek] ?></h2>
        <h1><?= "$dateNowDayOfMonth de $monthOfYearNames[$dateNowMonth] de $dateNowYear" ?></h1>
    </div>
</body>

</html>