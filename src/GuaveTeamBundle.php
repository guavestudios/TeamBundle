<?php

namespace Guave\TeamBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GuaveTeamBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
