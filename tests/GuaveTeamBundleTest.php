<?php

declare(strict_types=1);

namespace Guave\TeamBundle\Tests;

use Guave\TeamBundle\GuaveTeamBundle;
use PHPUnit\Framework\TestCase;

class GuaveTeamBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new GuaveTeamBundle();

        $this->assertInstanceOf('Guave\TeamBundle\GuaveTeamBundle', $bundle);
    }
}
