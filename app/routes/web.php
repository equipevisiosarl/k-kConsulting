<?php

use phpFx\routerFx\Router;

Router::addRoute('GET', '/', function (){ loadView('pages/Welcome'); });

