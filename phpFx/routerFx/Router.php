<?php

namespace phpFx\routerFx;

use Exception;

class Router
{

    private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
    private static $routes = []; // Contiendra la liste des routes
    private static $nameRoute = []; // Contiendra la liste des routes nommé
    private $request ;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this -> request = new Request();
    }

    public static function addRoute(string $method, string $path,  $handler, ?string $name = null): Route
    {
        #detection de l api
        if (explode('/', get_url())[0] == 'api') {
            $path = 'api/' . $path;
        }

        $route = new Route($path, $handler, $method);
        static::$routes[$method][$path] = $route;

        if (!$name) {
            $name = $path;
        }

        $nameRoute = explode(':', $name);

        if ($name && $nameRoute[0] == 'name') {
            static::$nameRoute[$nameRoute[1]] = $route;
        }
        return $route;

        
    }


    public static function getRoutes(string $method): array
    {
        return static::$routes[$method] ?? [];
    }

    public function run()
    {
        $requestMethod = $this -> request -> methodRequest(); //strtoupper($_SERVER['REQUEST_METHOD']);

        if (!isset(static::$routes[$requestMethod])) {
            throw new \Exception('REQUEST_METHOD does not exist');
        }

        if ($requestMethod == 'POST') {
            $token = $this -> request -> post('token_crsf');  //debug($token); debug($_SESSION['crsf']);
            $verifie = isset($token) && $token ==  $_SESSION['crsf'] ;
            $_SESSION['post'] = $this -> request -> post();
            if (!$verifie) {
               throw new \Exception('jeton manquant verifier votre formulaires');
            }
        }
        $this -> request -> unset_post('token_crsf');
        //unset($_SESSION['crsf']);
        foreach (static::$routes[$requestMethod] as $route) {
            if ($route->match($requestMethod, $this->url)) {
                return $route->call();
            }
        }

        throw new \Exception('No matching routes with url : '.$this->url);
    }


    public function runApi()
    {
        $requestMethod =  $this -> request -> methodRequest();//strtoupper($_SERVER['REQUEST_METHOD']);

        // Les entêtes requises
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset= UTF-8");
        header("Access-Control-Allow-Methods: $requestMethod");

        // Vérifier si la méthode est supportée
        if (!isset(static::$routes[$requestMethod])) {
            $response = ['success' => false, 'message' => "Aucune route trouvée avec la méthode $requestMethod"];
        } else {
            $routeFound = false;

            foreach (static::$routes[$requestMethod] as $route) {
                if ($route->match($requestMethod, $this->url)) {
                    $response = $route->call();
                    $routeFound = true;
                    break;
                }
            }

            // Si aucune route n'a été trouvée
            if (!$routeFound) {
                $response = ['success' => false, 'message' => "Aucune route ne correspond à votre URL " . $this->url, static::$routes];
            }
        }

        // Encodage JSON et envoi de la réponse
        echo json_encode($response);

        // Terminer l'exécution du script
        exit();
    }

    public function link_url($name, $params = []){
        if(!isset(static::$nameRoute[$name])){
            throw new Exception("aucune route ne corespond a $name"); 
            //exit();
        }

        return static::$nameRoute[$name]->getUrl($params);
    }
}
