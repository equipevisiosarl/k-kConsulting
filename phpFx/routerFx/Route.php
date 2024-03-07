<?php

namespace phpFx\routerFx;


class Route
{

    private $path;
    private $handler;
    private $method;
    private $name;
    private $params = [];
    private $matches;


    public function __construct($path, $handler, $method)
    {
        $this->path = trim($path, '/');  // On retire les / inutils
        $this->handler = $handler;
        $this->method = $method;
    }

    public function match($requestMethod, $requestPath)
    {
        return $this->method === $requestMethod && $this->matchPath($requestPath);
    }


    private function matchPath($requestPath)
    {
        $pattern = $this->path;

        // Replace :param[a-z] or :param[0-9] with regex pattern
        $pattern = preg_replace_callback('#:([\w]+)(?:\[([\w-]+)\])?#', function ($matches) {
            $param = $matches[1];
            $type = isset($matches[2]) ? $matches[2] : null;

            if ($type !== null) {
                return "(?<$param>[$type-]+)";
            } else {
                return "(?<$param>[^/]+)";
            }
        }, $pattern);


        $pattern = '#^' . $pattern . '$#i';

        if (preg_match($pattern, $requestPath, $matches)) {
            array_shift($matches);
            foreach ($matches as $key => $value) {
                if (is_int($key)) {
                    unset($matches[$key]);
                }
            }

            $this->matches = $matches;  // On sauvegarde les paramètres dans l'instance pour plus tard
            return true;
        }

        return false;
    }

    public function call()
    {
        if (is_callable($this->handler)) {
            return call_user_func_array($this->handler, $this->matches);
        } else {

            if (isset($this->handler['output'])  == 'controller') {
                $app = new Render($this->handler, $this->matches);
                $app->render_controller();

                #detection de l api
                if (explode('/', get_url())[0] == 'api') {
                    return $app->render_controller();
                }

            } else {
                throw new \Exception("Erreur lors de l'exécution de la route");
            }
        }
    }

    public function getUrl($params){

        $path = $this -> path;
        foreach ($params as $key => $value) {
            $path = str_replace(":$key", $value, $path);
        }
        return supprimerStringsEntreCrochets($path);
    }
}
