<?php

/**
 * La classe Controller permet de mettre en forme les futurs controllers
 * Elle embarque les attributs liés à la base de données ainsi
 * qu'à l'envoie de la vue à l'utilisateur.
 * 
 * PHP version 7.4.2
 * 
 * @author Robin Bidanchon <robin.bidanchon@gmail.com>
 * @link Toutes les pages
 */

namespace App\Foundation;

use PDO;
use Twig\Environment;
use Twig\TwigFunction;
use Twig\Loader\FilesystemLoader;
use App\Foundation\Router;

/**
 * @category Controller
 * @package TimePHP
 * @subpackage Foundation
 */
abstract class Controller
{

    /**
     * @var Environment Permet de retourner la vue correspondante à l'utilisateur
     */
    protected $twig;

    /**
     * @var PDO Permet de requêter la base de données
     */
    protected $db;

    public function __construct()
    {
        //chargement du fichier app.ini à la racine du projet
        $configContent = parse_ini_file("../../config.ini");
        $this->twig = new Environment(new FilesystemLoader(__DIR__ . "/../../". $configContent["view_path"]));

        // ajout de la fonction asset pour twig afin de récuperer l'url du dossier asset dans le repertoire public
        $this->twig->addFunction(new TwigFunction('asset', function ($asset): string
        {
            return sprintf('/../assets/%s', ltrim($asset, '/'));
        }));
        $this->twig->addFunction(new TwigFunction('generate', function (string $nameUrl, array $params = []): string
        {
            return sprintf(Router::$router->generate($nameUrl, $params));
        }));
        $this->twig->addFunction(new TwigFunction('dump', function ($object): string
        {
            return var_dump($object);
        }));

        $connexion = "mysql:host=".$configContent["myHost"].";dbname=".$configContent["myName"];
        $this->db = new PDO($connexion, $configContent["myUser"], $configContent["myPass"]);
        // permet d'afficher un rapport des erreurs
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // indique que le mode par défaut pour le fetch est FETCH_ASSOC
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // converti les chaines de caractères vides en variables NULL
        $this->db->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
    }

}