<?php

/**
 * Le fichier sert à créer des fonctions/fonctionnalités additionnelles pour le projet.
 * Ces fonctions pourront êre utilisées dans tous les fichiers
 * du projet grâce à l'autoload file de composer
 * 
 * PHP version 7.4.2
 * @category Functions
 * @author Robin Bidanchon <robin.bidanchon@gmail.com>
 * @link Toutes les pages
 */

use App\Foundation\Router;
use Cocur\Slugify\Slugify;

/**
 * Converti le titre d'un article en slug (chaine de caractère minuscule séparée par des "-")
 * 
 * @param string $title Titre que l'on veut convertir en slug
 * @param string $separator Separateur que l'on va utiliser pour la conversion en slug
 * @return string
 */
function slugify(string $title, string $separator): string
{
    $slug = new Slugify();
    return $slug->slugify($title, $separator);
}

/**
 * Parcour une liste d'élément et converti un string en int si c'est possible.
 * 
 * @param array $array correspond à la variable $match qui est placée en paramètre
 * @return array
 */
function convertArrayInt(array $array): array
{
    // conversion des nombres de l'url en entier car de base, se sont des strings
    foreach($array["params"] as $key => $value) {
        if(is_numeric($value) && gettype($value) === "string") {
            $array["params"][$key] = (int)$value;
        }
    }
    return $array;
}

/**
 * Fait une redirection vers la page d'accueil si le résultat d'une requête sql est vide
 * 
 * @param object $pdoQuery Résultat de la requête après execution
 */
function redirectIfNoResult(object $pdoQuery)
{
    if($pdoQuery->rowCount() === 0){
        // redirection permanente (301)
        header("Location: ".Router::$router->generate("home"), true, 301);
    }
}
