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
        $lst_result = $this->db->query("SELECT * FROM User");
        echo $this->twig->render("home.twig", [
            "users" => $lst_result
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
        $lst_result = $this->db->prepare("SELECT * FROM Article WHERE user_id =  ?");
        $lst_result->bindValue(1, $idUser, PDO::PARAM_INT);
        $lst_result->execute();
        echo $this->twig->render("articles.twig", [
            "articles" => $lst_result
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
        $lst_result = $this->db->prepare("SELECT * FROM Article WHERE id =  ? AND slug = ?");
        $lst_result->bindValue(1, $idArticle, PDO::PARAM_INT);
        $lst_result->bindValue(2, $slug, PDO::PARAM_STR);
        $lst_result->execute();

        if($lst_result->rowCount() === 0){
            header("Location: ".Router::$router->generate('home'));
        }else{

            echo $this->twig->render("articleFull.twig", [
                "article" => $lst_result->fetch()
                ]);
            }


    }
}