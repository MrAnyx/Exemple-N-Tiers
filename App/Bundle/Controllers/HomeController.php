<?php

/**
 * La classe HomeController permet de gérer la récupération de données pour
 * ensuite les envoyer à la vue correspondante.
 * Cette classe étend Controller ce qui lui permet d'utiliser les variable $twig et $_whoops
 * 
 * PHP version 7.4.1
 * 
 * @category Controller
 * @package TimePHP
 * @subpackage Bundle\Controllers
 * @author Robin Bidanchon <robin.bidanchon@gmail.com>
 * @license MPL-2.0 https://github.com/MrAnyx/Skeleton-TimePHP/blob/master/LICENSE
 * @link http://domaine.com/
 */

namespace App\Bundle\Controllers;

use PDO;
use App\Foundation\Router;
use App\Foundation\Controller;

/**
 * Controller de la page d'accueil
 * 
 * @category Controller
 * @package TimePHP
 * @subpackage Bundle\Controller
 * @link http://domaine.com
 */
class HomeController extends Controller
{

    /**
     * Récupère l'ensemble des utilisateurs
     * 
     * @see http://domaine.com/
     */
    public function getUsers()
    {
        $users = $this->db->query("SELECT * FROM User");
        echo $this->twig->render("home.twig", [
            "users" => $users
        ]);
    }

    /**
     * Récupère l'ensemble des articles d'un utilisateur
     * 
     * @param int $idUser ID de l'utilisateur selectionné
     * @see http://domaine.com/user/[int:idUser]
     */
    public function getArticleByUser(int $idUser)
    {
        $articlesByUser = $this->db->prepare("SELECT * FROM Article WHERE idUser =  ?");
        $articlesByUser->bindValue(1, $idUser, PDO::PARAM_INT);
        $articlesByUser->execute();
        echo $this->twig->render("articles.twig", [
            "articles" => $articlesByUser
        ]);
    }


    /**
     * Récupère l'intégralité d'un article
     * 
     * @param int $idArticle Correspond à l'id de l'article sur lequel on a cliqué
     * @param string $slug Designe le slug de l'article
     * @see http://domaine.com/article/[int:idArticle]/[string:slug]
     */
    public function getFullArticle(int $idArticle, string $slug)
    {
        $article = $this->db->prepare("SELECT * FROM Article WHERE id =  ? AND slug = ?");
        $article->bindValue(1, $idArticle, PDO::PARAM_INT);
        $article->bindValue(2, $slug, PDO::PARAM_STR);
        $article->execute();

        if($article->rowCount() === 0){
            header("Location: ".Router::$router->generate('home'));
        }else{

            echo $this->twig->render("articleFull.twig", [
                "article" => $article->fetch() // On met le fetch car on a qu'un seul element qui est retourné par la requête
                ]);
        }

    }
}