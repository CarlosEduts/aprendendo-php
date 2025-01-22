<?php
// Define o fuso horário
date_default_timezone_set('America/Bahia');
$pageCreatedOn = strtotime("2025-01-22 11:42:10");

function formatTime(string $timeCreatedPage)
{
    $timeNow = strtotime(date("Y-m-d H:i:s"));

    $formatedTime = "";

    // Calcula a diferença em segundos
    $timeDifference = $timeNow - $timeCreatedPage;

    // Converte a diferença
    $years = floor($timeDifference / (365 * 24 * 60 * 60));
    $timeDifference %= (365 * 24 * 60 * 60);

    $months = floor($timeDifference / (30 * 24 * 60 * 60));
    $timeDifference %= (30 * 24 * 60 * 60);

    $days = floor($timeDifference / (24 * 60 * 60));
    $timeDifference %= (24 * 60 * 60);

    $hours = floor($timeDifference / (60 * 60));
    $timeDifference %= (60 * 60);

    $minutes = floor($timeDifference / 60);
    $seconds = $timeDifference % 60;


    if ($years > 0) {
        $formatedTime .= $years == 1 ? "1 year " : $years . " years ";
    }
    if ($months > 0) {
        $formatedTime .= $months == 1 ? "1 month " : $months . " months ";
    }
    if ($days > 0) {
        $formatedTime .= $days == 1 ? "1 day " : $days . " days ";
    }
    if ($hours > 0) {
        $formatedTime .= $hours == 1 ? "1 hour " : $hours . " hours ";
    }
    if ($minutes > 0) {
        $formatedTime .= $minutes == 1 ? "1 minute " : $minutes . " minutes ";
    }
    if ($seconds > 0) {
        $formatedTime .= $seconds == 1 ? "and 1 second " : "and " . $seconds . " seconds ";
    }

    return $formatedTime;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page created on</title>
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
            font-family: Calibri, 'Trebuchet MS', sans-serif;
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
        <p>Page created On</p>
        <h1><?php echo formatTime($pageCreatedOn); ?></h1>
    </div>
</body>

</html>