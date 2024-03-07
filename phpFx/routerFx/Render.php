<?php

namespace phpFx\routerFx;

//gere les rendu coté des controllers et des vues
class Render
{

    protected $output;
    protected $params;
    protected $path = ROOT;
    protected $pathView = ROOT.'app/views/';

    public function __construct($output, $params)
    {
        $this->output = $output;
        $this->params = $params;
    }

    public function render_controller()
    {

        $controllerName = $this->output['controller'];
        $controllerPath = $this->path . $controllerName . '.php';
        $action = $this->output['action'];
        $parametres = $this->params;

        //verifion si le controller existe
        if (file_exists($controllerPath)) {
            //require_once $controllerPath;
            $controller = new $controllerName();
        } else {
            // Affichage d'une erreur si le contrôleur n'existe pas
            throw new \Exception("controller Not Found");
        }

        //verifions si la methode existe 
        if (method_exists($controller, $action)) {

            $function = array($controller, $action);
            (call_user_func_array($function,  $parametres));


            #detection de l api
            if (explode('/', get_url())[0] == 'api') {
                return (call_user_func_array($function, $parametres));
            }
        } else {
            // Affichage d'une erreur si la méthode n'existe pas
            throw new \Exception("methode Not Found");
        }
    }

    public function Render_view()
    {
        $view = $this->pathView . $this->output['view'] . '.php';
        //verifion si la vue existe
        if (file_exists($view)) {
            $data = $this->output['data'];
            foreach ($data as $key => $value) {
                $$key = $value;
            }
            require_once $view;
        } else {
            // Affichage d'une erreur si le contrôleur n'existe pas
            throw new \Exception(" Error : page 404  view " . $view . " Not Found");
        }
    }
}
