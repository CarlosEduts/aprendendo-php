<?php
// Obter a conexão PDO
function getDbConnection()
{
    try {
        $dbPath = "blog.sqlite";

        $pdo = new PDO('sqlite:' . $dbPath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
    }
}
