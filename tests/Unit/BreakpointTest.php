<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Tests\Unit;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\Model\Breakpoint;
use Lendable\Interview\Interpolation\TermData\Constants;

/**
 * Class BreakpointTest
 */
class BreakpointTest extends Base
{
    /**
     * Asserts breakpoint create validations
     */
    public function testMissingBreakpointAttributes()
    {
        $exceptionData = [
            'class'   => Exception\MissingBreakpointAttributesException::class,
            'message' => 'Required breakpoint attributes are missing.',
        ];

        $this->runUnderExceptionHandler(function ()
        {
            $data = [Constants::AMOUNT => 1000];

            new Breakpoint($data);
        }, $exceptionData);
    }
}
