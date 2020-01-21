<?php

/**
 * Point d'entrée de l'application. C'est ici que sont redirigées l'ensemble des urls
 * (grâce au .htaccess pour apache)
 * 
 * PHP version 7.4.1
 * 
 * @category Router
 * @package None
 * @subpackage None
 * @author Robin Bidanchon <robin.bidanchon@gmail.com>
 * @license MPL-2.0 https://github.com/MrAnyx/Skeleton-TimePHP/blob/master/LICENSE
 * @link Toutes les pages
 */

// Charge l'ensemble des classes et le fichier function.php via composer.json
require __DIR__ . "/../../vendor/autoload.php";

use App\Foundation\Router;

$router = new Router();

// Routes disponibles
$router
    ->get("/", "HomeController#getUsers", "home")
    ->get("/user/[i:idUser]", "HomeController#getArticleByUser", "articleByUser")
    ->get("/article/[i:idArticle]/[*:slug]", "HomeController#getFullArticle", "article")
    ->run();

