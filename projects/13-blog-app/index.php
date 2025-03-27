<?php

// Configurações do twid a roteamento de URLs
include './database/create_db.php';
include './includes/config.php';
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader, ['cache' => false]);

$pdo = getDbConnection();
$stmt = $pdo->query("SELECT * FROM posts");

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

if (preg_match('/^\/categorie\/(\w+)$/', $request)) {
    require 'views/post.php';
} elseif (preg_match('/^\/post\/(\d+)$/', $request)) {
    require 'views/view_post.php';
} else {
    match ($request) {
        "/" => require 'views/home.php',
        "/create-post" => require 'views/create.php',
        default => 'views/home.php'
    };
}
