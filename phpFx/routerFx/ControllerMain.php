<?php

namespace phpFx\routerFx;

use phpFx\SqlFx\SqlBuilder;
use phpFx\SqlFx\Validate;

class ControllerMain  extends Request
{
    use SqlBuilder;
    use Validate;

    protected $primaryKey = 'id';
}
