<?php

$dbPath = "blog.sqlite";
try {
    $pdo = new PDO ('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criando tabela de posts
    $pdo->exec("CREATE TABLE IF NOT EXISTS posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        category TEXT NOT NULL,
        content TEXT NOT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    echo "Banco de dados criado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar banco de dados: " . $e->getMessage();
}