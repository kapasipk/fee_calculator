<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Tests\Unit;

use \PHPUnit\Framework\TestCase;

/**
 * Class Base
 *
 * @package Lendable\Interview\Interpolation\Tests\Unit
 */
class Base extends TestCase
{
    /**
     * Base setUp. Executes operations before the start of each test
     */
    public function setUp()
    {
        parent::setUp();

        // custom setUp operations go here
    }

    /**
     * Base tearDown. Executes operations after the end of each test
     */
    public function tearDown()
    {
        // custom tearDown operations go here

        parent::tearDown();
    }

    /**
     * Runs a closure which is expected to throw an exception under the try-catch block and asserts the exception data.
     *
     * @param \Closure $closure
     * @param array    $expectedExceptionData
     */
    public function runUnderExceptionHandler(\Closure $closure, array $expectedExceptionData)
    {
        $expectedExceptionClass = $expectedExceptionData['class'];
        $expectedExceptionMsg   = $expectedExceptionData['message'];

        try
        {
            $closure();
        }
        catch(\Throwable $exception)
        {
            if (get_class($exception) !== $expectedExceptionClass)
            {
                $this->fail('Exception ' . $expectedExceptionClass . ' expected but ' . get_class($exception) . ' caught');
            }

            $this->assertEquals($expectedExceptionMsg, $exception->getMessage());
        }
        finally
        {
            if (isset($exception) === false)
            {
                $this->fail('Exception ' . $expectedExceptionClass . ' expected but none caught');
            }
        }
    }
}
