<?php

// Consultar a api e mostra ao usuário a frase motivacional e o nome do autor
// Requisitando dados e transformando em json
$apiURL = "https://zenquotes.io/api/random";
$response = file_get_contents($apiURL);
$fraseDataArray = json_decode($response, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random motivational frase</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            background: linear-gradient(90deg,
                    <?php echo "rgb(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")"; ?> 0%,
                    <?php echo "rgb(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")"; ?> 100%);
            width: 100%;
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 1rem;
        }

        h1 {
            text-align: center;
            font-size: 3rem;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container" onclick="window.location.reload()">
        <h1> <?php echo $fraseDataArray[0]["q"]; ?> </h1>
        <p> <?php echo $fraseDataArray[0]["a"]; ?> </p>
    </div>
</body>

</html>