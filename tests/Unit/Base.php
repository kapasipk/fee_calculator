<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Tests\Unit;

use \PHPUnit\Framework\TestCase;

class Base extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // custom common constructor operations go here
    }

    public function tearDown()
    {
        // custom tearDown operations go here

        parent::tearDown();
    }
}
