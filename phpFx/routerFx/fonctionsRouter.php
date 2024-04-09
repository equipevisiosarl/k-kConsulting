<?php

use phpFx\routerFx\Render;
use phpFx\routerFx\Router;

function  loadView($view, array $data = [])
{ // charge une vue
    $output = ['output' => 'view', 'view' => $view, 'data' => $data];
    $app = new Render($output, $data);
    return $view = $app->Render_view(); 
}

function  loadController($controller, $action)
{ //charge un controller
    return ['output' => 'controller', 'controller' => $controller, 'action' => $action];
}

function get_url()
{ //renvoie L'url partielle
    $URL = $_GET['url'] ?? '';
    return trim($URL, '/');
}

function view($view)
{
    return ROOT . 'app/views/' . $view . '.php';
}


function viewComponent($component)
{
    return view("components/$component");
}

function viewTemplate($template)
{
    return view("templates/$template");
}

function viewPage($page)
{
    return view("page/$page");
}

function controller($controller)
{
    return ROOT . 'app/controllers/' . $controller . '.php';
}

function model($model)
{
    return ROOT . 'app/models/' . $model . '.php';
}

function route($name, $params = []){
    $path = new Router(get_url());
    $url = $path->link_url($name, $params);
    return URL.$url;
}

function supprimerStringsEntreCrochets($chaine) {
    // Utilisation d'une expression régulière pour supprimer les parties entre crochets
    return preg_replace('/\[[^\]]*\]/', '', $chaine);
}

