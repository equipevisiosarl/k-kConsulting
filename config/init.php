<?php

require_once '../config/config.php';

//recense toutes les dependances a l 'applications
$dependencies =  [
    'phpFx/fonctionsFx/fonctionsFx.php',
    'phpFx/routerFx/fonctionsRouter.php',
    'app/functions_project.php',
];

//inclut toutes les dependances a l 'applications
foreach ($dependencies as $dependency){
    require_once ROOT.$dependency;
}