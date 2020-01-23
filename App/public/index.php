<?php

/**
 * Point d'entrée de l'application. C'est ici que sont redirigées l'ensemble des urls
 * (grâce au .htaccess pour apache)
 * 
 * PHP version 7.4.2
 * 
 * @author Robin Bidanchon <robin.bidanchon@gmail.com>
 * @link Toutes les pages
 */

// Charge l'ensemble des classes et le fichier function.php via composer.json
require __DIR__ . "/../../vendor/autoload.php";

use App\Foundation\Router;

$router = new Router();

// Routes disponibles
$router
    ->get("/", "BlogController#getUsers", "home")
    ->get("/user/[i:idUser]", "BlogController#getArticleByUser", "articleByUser")
    ->get("/article/[i:idArticle]/[*:slug]", "BlogController#getFullArticle", "article")
    ->run();

