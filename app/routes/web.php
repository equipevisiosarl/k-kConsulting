<?php

use app\controllers\HumainController;
use phpFx\routerFx\Router;

Router::addRoute('GET', '/', function (){ loadView('pages/Welcome'); });
Router::addRoute('GET', '/a-propos/qui-sommes-nous', function (){ loadView('pages/qsn'); });
Router::addRoute('GET', '/contact', function (){ loadView('pages/contact'); });
Router::addRoute('GET', '/a-propos/equipe',  loadController(HumainController::class, 'index'));
Router::addRoute('GET', '/a-propos/consultants',  loadController(HumainController::class, 'consultants'));
Router::addRoute('GET', '/a-propos/partenariat', function (){ loadView('pages/partenariat'); });


