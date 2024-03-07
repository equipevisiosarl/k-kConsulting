<?php

namespace config;

use phpFx\ExeptionsFx\FxException;
use phpFx\routerFx\Router;

//permet de contruire la page demander
class Builder
{
    private string $url;
    public function __construct(string $url)
    {
        $this->url = trim($url, '/');
    }

    public function build()
    {
        try {
            require_once  '../config/init.php';
            DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);
            $router = new Router($this->url);
           try {
            if (explode('/', $this->url)[0] == 'api') {
                require_once ROOT . 'app/routes/api.php';
                $router->runApi();
            } else {
                require_once ROOT . 'app/routes/web.php';
                $router->run();
            }
           } catch (\Throwable $th) {
            $errorMessage =  $th->getMessage();
            include_once ROOT . 'phpFx/ExeptionsFx/pageError.php';
            die;
           }
        } catch (FxException $e) {
            
        }
    }
}
