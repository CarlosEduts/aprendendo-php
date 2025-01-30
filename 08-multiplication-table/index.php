<?php
$generatedTable = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number = $_POST['number'];
    $type = $_POST['type'];

    $generatedTable = generateTable($number, $type);
}

function generateTable(int $number, string $type)
{
    $table = "";

    if ($type == "sum") {
        for ($i = 0; $i <= 10; $i++) {
            $table .= "{$number} + {$i} = <strong>" . ($number + $i) . "</strong><br>";
        }
    }

    if ($type == "subtraction") {
        for ($i = 0; $i <= 10; $i++) {
            $table .= "{$number} - {$i} = <strong>" . ($number - $i) . "</strong><br>";
        }
    }

    if ($type == "multiplication") {
        for ($i = 0; $i <= 10; $i++) {
            $table .= "{$number} x {$i} = <strong>" . ($number * $i) . "</strong><br>";
        }
    }

    if ($type == "division") {
        for ($i = 1; $i <= 10; $i++) {
            $table .= "{$number} / {$i} = <strong>" . ($number / $i) . "</strong><br>";
        }
    }

    return $table;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Table</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        strong {
            color: green;
        }

        p {
            font-size: 1rem;
            background-color: #eee;
            padding: 10px;
        }

        .content,
        form {
            margin: 1rem;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 0.9rem;
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }

        select,
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .checkbox-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .checkbox-group input {
            margin-right: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #555;
        }

        @media (max-width: 500px) {
            h1 {
                font-size: 1.5rem;
            }

            button {
                font-size: 0.9rem;
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Multiplication Table</h3>
        <form method="POST">
            <input type="number" name="number" id="" min="0" max="100">
            <select name="type" id="">
                <option value="sum" selected>sum</option>
                <option value="subtraction">subtraction</option>
                <option value="multiplication">multiplication</option>
                <option value="division">division</option>
            </select>
            <button type="submit">Create table</button>
        </form>
        <div class="content">
            <?= $generatedTable ?>
        </div>
    </div>
</body>

</html>