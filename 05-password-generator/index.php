<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $length = (int) $_POST['tamanho'];
    $includeUppercase = isset($_POST['incluir_maiusculas']);
    $includeNumber = isset($_POST['incluir_numeros']);
    $includeSybols = isset($_POST['incluir_simbolos']);

    // Gerar senha
    function generatePass($length, $includeUppercase, $includeNumber, $includeSybols)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz'; // caracteres padão

        if ($includeUppercase) {
            $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($includeNumber) {
            $chars .= '0123456789';
        }
        if ($includeSybols) {
            $chars .= '!@#$%^&*?';
        }

        $pass = '';
        $maxLength = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $pass .= $chars[random_int(0, $maxLength)];
        }

        return $pass;
    }

    $generatedPass = generatePass($length, $includeUppercase, $includeNumber, $includeSybols);
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Senhas</title>
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

        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #555;
        }

        h2 {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #666;
        }

        p {
            font-size: 1rem;
            background-color: #eee;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            word-break: break-word;
        }

        form {
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
        <h1>Gerador de Senhas</h1>
        <div>
            <h2>Senha gerada:</h2>
            <p><?= $generatedPass ?></p>
        </div>
        <form method="POST" action="">
            <label for="tamanho">Tamanho da Senha:</label>
            <input type="number" name="tamanho" id="tamanho" max="60" required>
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="incluir_maiusculas" checked> Incluir Letras Maiúsculas
                </label>
                <label>
                    <input type="checkbox" name="incluir_numeros" checked> Incluir Números
                </label>
                <label>
                    <input type="checkbox" name="incluir_simbolos" checked> Incluir Símbolos
                </label>
            </div>
            <button type="submit">Gerar Senha</button>
        </form>
    </div>
</body>

</html>