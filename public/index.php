<?php

session_start();

use config\Builder;
use phpFx\ExeptionsFx\FxError;

require_once __DIR__.'/../config/Autoload.php';

$Fxerror = new FxError();
// Set the custom exception handler
set_exception_handler([$Fxerror, 'handleException']); 
// Set the custom error handler
set_error_handler([$Fxerror, 'handleError']);

$builder = new Builder($_GET['url']);

$render = $builder-> build();


