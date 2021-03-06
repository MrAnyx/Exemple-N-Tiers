<?php

/**
 * La classe Router sert à gérer les url et associe les url au bon controller
 * Elle embarque la variable pour le routage, pour calculer le temps de chargement
 * ainsi que pour la gestion des erreurs
 * 
 * PHP version 7.4.2
 * 
 * @author Robin Bidanchon <robin.bidanchon@gmail.com>
 * @link Toutes les pages
 */

namespace App\Foundation;

use AltoRouter;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

/**
 * @category Router
 * @package TimePHP
 * @subpackage Foundation
 */
class Router
{

    /**
     * @var AltoRouter Variable principale du router
     */
    public static $router;

    /**
     * @var int Variable qui permet de calculer le temps de chargement
     */
    public static $loadingTime;

    /**
     * @var Whoops Générateur de belles pages d'erreurs
     */
    private $_whoops;

    public function __construct()
    {
        self::$router = new AltoRouter();
        self::$loadingTime = microtime(true);
        $this->_whoops = new Run;
        $this->_whoops->pushHandler(new PrettyPageHandler);
        $this->_whoops->register();
    }

    /**
     * Permet d'ajouter une nouvelle route
     * 
     * @param string $url Url utilisée pour lancer le controller
     * @param object $object Fonction or String representant le controller
     * @param string|null $name (optional) name of the path
     * @return self Permet de faire du fluant calling
     */
    public function get(string $url, $object, ?string $name): self
    {
        self::$router->map("GET", $url, $object, $name);
        return $this;
    }

    /**
     * Permet de generer une url via le nom de la route
     * 
     * @param string $name Correspond au nom de la route que l'on souhaite
     * @param array|null $params (optionel) correspond au parametres à donner a l'url
     * @return string
     * @deprecated 
     */
    public function url(string $name, array $params): string
    {
        return self::$router->generate($name, $params);
    }

    /**
     * Permet d'associer le bon controller / fonction avec l'url saisi
     */
    public function run()
    {
        $match = self::$router->match();

        // si l'url ne correspond à aucune des routes
        if ($match === false) {
            header("Location: ".self::$router->generate("home")); //redirection vers la page d'accueil

        // si on renseigne un controller (BlogController#function) 
        } else if(is_string($match["target"])) {
            list($controller, $function) = explode('#', $match['target']);
            $ctrl = "App\\Bundle\\Controllers\\".$controller;
            if (is_callable(array(new $ctrl, $function))) {
                call_user_func_array(array(new $ctrl,$function), $match['params']);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
            }
        
        // si on renseigne une fonction au lieu d'un controller
        } else if(is_object($match["target"]) && is_callable($match["target"])) {
            call_user_func_array($match["target"], $match["params"]);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
        }
    }

}
