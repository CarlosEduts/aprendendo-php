<?php

// Usando classes para criar mensagem de alerta
class UserMessage
{
    private $message;
    private $style = "
      width: 100%;
      max-width: 500px;
      padding: 15px 20px;
      border-radius: 8px;
      margin-bottom: 10px;
      color: #fff;
      text-align: center;
    ";

    public function __construct(string $message, string $style = "success")
    {
        $this->message = $message;

        if ($style == "alert") {
            $this->style .= $this->alertStyle();
        } elseif ($style == "error") {
            $this->style .= $this->errorStyle();
        } else {
            $this->style .= $this->successStyle();
        }
    }

    private function alertStyle(): string
    {
        return "
            background-color:rgba(255, 193, 7, 0.3);
            border: 1px solid #e0a800;
            color: #e0a800;
        ";
    }

    private function successStyle(): string
    {
        return "
            background-color:rgba(40, 167, 70, 0.3);
            border: 1px solid #218838;
            color: #218838;
        ";
    }

    private function errorStyle(): string
    {
        return "
            background-color:rgba(220, 53, 70, 0.3);
            border: 1px solid #c82333;
            color: #c82333
        ";
    }

    public function __toString()
    {
        return "<div style='$this->style'>$this->message</div>";
    }
}

// Criando as mensagens
$alert = new UserMessage('One alert message!', 'alert');
$success = new UserMessage('One success message!', 'success');
$error = new UserMessage('One error message!', 'error');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Message with class</title>

    <style>
        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <?= $alert ?>
        <?= $success ?>
        <?= $error ?>
    </div>
</body>

</html>