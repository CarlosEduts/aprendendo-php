<?php

// Mostrar oa usuário uma palavra aleatória em inglês
$apiUrl = "https://random-word-api.herokuapp.com/word";

// Fazendo a requisição GET & Convertendo a resposta JSON para array PHP
$response = file_get_contents($apiUrl);
$wordArray = json_decode($response, true);

$word = "";

if (!empty($wordArray)) {
    $word = $wordArray[0];
} else {
    $word = "Error to get word";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn new word</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            background-color: <?php echo "rgb(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")"; ?>;
            width: 100%;
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h1 {
            font-size: 3.5rem;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container" onclick="window.location.reload()">
        <h1><?php echo $word; ?></h1>
    </div>
</body>

</html>